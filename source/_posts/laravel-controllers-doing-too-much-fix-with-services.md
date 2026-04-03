---
extends: _layouts.post
section: content
title: "Your Laravel Controllers Are Doing Too Much. Fix Them With Services"
date: 2026-04-03
description: "If your controller methods stretch past 150 lines, something went wrong. Learn how to extract business logic into Service classes and keep your controllers clean."
categories: [tips, refactoring]
---

If you've ever scrolled through a Laravel controller method that stretches past 150 lines, you already know something went wrong. That `store()` method started innocent enough: a couple of Eloquent calls, maybe a validation check. Six months later it's calculating discounts, firing off three different notifications, provisioning resources, and somehow also handling retry logic for a third-party API.

> That's not a controller anymore. That's a god object wearing a controller's name tag.

---

### Where Things Go Sideways

Controllers exist to do one thing: receive HTTP input, hand it off to something that knows what to do with it, and return a response. The moment you start embedding domain rules (pricing calculations, permission assignments, infrastructure provisioning) inside a controller action, you're creating a coupling that will haunt you later.

Here's what typically happens. A developer builds a `POST /api/teams/invite` endpoint. The controller validates the email, checks the team's seat limit, creates an invitation record, generates a signed URL, sends the email, logs an audit event, and bumps a usage counter. It works. Ship it.

Then product asks:

> *"Can we also invite users via a CLI command for bulk onboarding?"*

Now you're staring at 90 lines of logic trapped inside an HTTP-aware class. You can't reuse any of it without duplicating code or doing something ugly like calling a controller from an Artisan command.

**This is exactly the trap the Service Pattern helps you escape.**

---

### Pulling Logic Into Its Own Layer

A Service class is nothing fancy. It's a plain PHP class that owns a specific slice of your business logic. No HTTP awareness, no request objects, no response formatting. Just inputs, rules, and outputs.

Let's rework that team invitation flow. Instead of cramming everything into `InviteController`, we create an `InvitationService`:

```php
namespace App\Services;

use App\Models\Team;
use App\Models\Invitation;
use App\Notifications\TeamInviteNotification;
use App\Exceptions\SeatLimitExceededException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvitationService
{
    public function inviteToTeam(Team $team, string $email, string $role = 'member'): Invitation
    {
        if ($team->members()->count() >= $team->plan->seat_limit) {
            throw new SeatLimitExceededException($team);
        }

        return DB::transaction(function () use ($team, $email, $role) {
            $invitation = Invitation::create([
                'team_id' => $team->id,
                'email' => $email,
                'role' => $role,
                'token' => Str::random(64),
                'expires_at' => now()->addDays(7),
            ]);

            $invitation->notify(new TeamInviteNotification($invitation));

            $team->increment('invitations_sent_count');

            return $invitation;
        });
    }
}
```

Everything that matters (the seat check, the transactional record creation, the notification dispatch, the usage tracking) lives here. No dependency on `Request`, no JSON formatting, no HTTP status codes.

---

### What the Controller Looks Like After

With the heavy lifting extracted, the controller shrinks to almost nothing:

```php
namespace App\Http\Controllers;

use App\Http\Requests\InviteTeamMemberRequest;
use App\Services\InvitationService;

class InviteController extends Controller
{
    public function __construct(private InvitationService $invitations) {}

    public function store(InviteTeamMemberRequest $request)
    {
        $invitation = $this->invitations->inviteToTeam(
            $request->user()->currentTeam,
            $request->validated('email'),
            $request->validated('role', 'member')
        );

        return response()->json([
            'invitation_id' => $invitation->id,
            'expires_at' => $invitation->expires_at->toIso8601String(),
        ], 201);
    }
}
```

> Accept the request, call the service, format the response. Each piece does exactly one job.

---

### And Now the Artisan Command Works Too

Remember the bulk onboarding requirement? With the logic living in `InvitationService`, the CLI command becomes trivial:

```php
namespace App\Console\Commands;

use App\Models\Team;
use App\Services\InvitationService;
use Illuminate\Console\Command;

class BulkInviteCommand extends Command
{
    protected $signature = 'team:bulk-invite {team_id} {file}';

    public function __construct(private InvitationService $invitations) {}

    public function handle()
    {
        $team = Team::findOrFail($this->argument('team_id'));
        $emails = file($this->argument('file'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($emails as $email) {
            try {
                $this->invitations->inviteToTeam($team, trim($email));
                $this->info("Invited: {$email}");
            } catch (\Throwable $e) {
                $this->error("Failed: {$email} - {$e->getMessage()}");
            }
        }
    }
}
```

**Zero duplication.** The exact same validation, transaction wrapping, and notification logic runs whether the trigger is an API call or a terminal command.

---

### Why This Matters Beyond Code Organization

Extracting services isn't just about aesthetics. There are three practical wins that compound over time.

**Testing becomes straightforward.** Unit testing a service class is painless. You instantiate it, mock the dependencies you care about, and assert outcomes. No need to spin up HTTP test cases or fake request objects just to verify that a seat limit gets enforced correctly.

**Swapping implementations gets cheap.** Say your notification strategy changes from email to Slack, or your billing provider switches. You modify the service (or swap the injected dependency) and every consumer (controllers, commands, queue jobs, scheduled tasks) picks up the change automatically.

**Onboarding developers is faster.** When a new team member opens `InvitationService`, they can read the entire invitation flow top to bottom in one file. Compare that to hunting through a bloated controller, trying to figure out which lines are HTTP plumbing and which lines are actual business rules.

---

### One Extra Step Most Tutorials Skip

Services work best when you also pair them with Laravel's Form Request classes for validation and custom Exceptions for error handling. Your service shouldn't be catching generic `\Exception`. Throw domain-specific exceptions like `SeatLimitExceededException` and let the caller (controller, command, job) decide how to present that error to the user. The controller renders a 422 JSON response; the Artisan command prints a red error line. Same rule, different presentation.

> This separation (service handles *what* to do, caller handles *how* to present it) is what keeps things clean as your app grows from a handful of endpoints to hundreds.

---

### The Takeaway

If you find yourself copying business logic between a controller and a command (or a job, or a Livewire component), that's your signal. Extract a service. Your future self, and anyone else who touches that codebase, will thank you.
