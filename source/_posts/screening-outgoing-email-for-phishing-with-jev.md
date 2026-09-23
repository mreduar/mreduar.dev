---
extends: _layouts.post
section: content
title: "Screening Every Outgoing Email for Phishing With Jev"
date: 2026-09-23
description: "Someone used our app to send phishing emails. Here is how we now check every email before it leaves, with a small classifier model that costs a couple of dollars per 100,000 emails."
categories: [tips]
---

Someone used [ManyRequests](https://manyrequests.com) to send phishing emails.

They did not break anything. They signed up, paid for the Pro plan, opened the client invitation template, and rewrote it into a phishing email. Then they started inviting people as clients.

Those invitations went out from our infrastructure, with our authenticated domain, through a perfectly healthy email provider. SPF passed. DKIM passed. DMARC passed. The email was, technically, flawless.

That is the problem. Everything we had was built to make our emails look legitimate, and it worked just as well for the attacker.

---

### Why the Usual Defenses Did Not Help

Any app that lets users customize an email has this hole. Invitation templates, comment notifications, announcements, invoice notes. If a user can type into it, a user can type a phishing email into it.

We already had signup defenses: hCaptcha, a business email requirement, a blocklist of throwaway domains and brand-impersonating keywords. None of that matters when the attacker is a paying customer. A Pro subscription gets you past every signup check, because from the outside it looks exactly like a new agency getting started.

The email provider does not help much either. Postmark, like most transactional providers, reacts to bounces and spam complaints. When those rise high enough, they pause your sending. That is useful, but it happens after the emails are already in people's inboxes.

What we needed was something that reads the email before it leaves and asks one question: would a client portal ever send this?

---

### Enter Jev

[Jev](https://typesafe.ai) is a classification model from TypeSafe. You do not chat with it. You give it a piece of state and a typed question, and it gives you back an answer with a probability. That is exactly the shape of this problem: here is an email, is it spam, how sure are you.

The [Laravel AI SDK](https://github.com/laravel/ai) ships a `typesafe` provider with a `Classification` API on top of it, so the integration ended up being one action and one listener.

---

### Hooking Into Every Email

Laravel fires `Illuminate\Mail\Events\MessageSending` right before any email hits the transport. If a listener returns `false`, the email is not sent. That covers notifications, mailables, and anything else that goes through the mailer, without touching a single notification class.

```php
// app/Providers/EventServiceProvider.php
MessageSending::class => [
    BlockSpamEmail::class,
],
```

The listener only decides whether to stop the send:

```php
class BlockSpamEmail
{
    public function __construct(protected EmailPassesSpamCheckAction $emailPassesSpamCheck) {}

    public function handle(MessageSending $event): ?bool
    {
        return $this->emailPassesSpamCheck->execute(
            $event->message,
            $event->data['__laravel_notification'] ?? null,
        ) ? null : false;
    }
}
```

Returning `null` instead of `true` matters. `null` lets the other `MessageSending` listeners keep running, `false` stops everything.

---

### Asking the Question

The action asks Jev a single boolean question and gets back a probability. The shape of the call looks like this:

```php
$answer = Classification::of($state)
    ->question('spam', new BooleanQuestion($question, $labels))
    ->classify()
    ->answer('spam');

if (! $answer->isTrue((float) config('manyrequests.spam_check.threshold'))) {
    return true;
}

// Log it and hold the email back.
return false;
```

The code is the easy part. Getting the question right took more than one try.

**The context is half the work.** Without telling the model what kind of app is sending the email, it has no idea what normal looks like. With that context, an invitation with emoji and a discount code reads as normal, and a link asking the reader to verify their bank account reads as very much not normal.

**Describe both labels, not just the bad one.** Telling the model what a legitimate email looks like cut false positives more than tightening the spam definition did.

**Expect to tune it with real traffic.** The first version flagged a couple of perfectly normal project conversations between an agency and its client. Out of context, some real work emails look a lot like phishing. Giving the model a bit more context about the kind of email it was reading fixed them without letting any of the spam samples through.

We keep the threshold high on purpose. Blocking a legitimate password reset costs us more than letting one spam email through, so we lean toward letting things pass, log everything we block, and tune from real data instead of guesses.

---

### Failing Open

This check sits in front of password resets, invoices and two-factor codes. If the classifier has a problem, those still have to go out.

So when the check cannot give an answer, we report the error and send the email anyway. The whole thing also sits behind a feature flag, so it can be turned off with an environment variable if it ever misbehaves.

An outage of the classifier means we are back to where we were before. It never means users stop getting their emails.

---

### Does It Work?

Before shipping, we ran it against a battery of real and synthetic emails.

**14 spam samples.** The actual phishing email as it was sent, the same attack replayed through the template override, crypto giveaways, pharmacy spam, adult bait, a Spanish bank phishing email, a 419 inheritance scam, streaming account phishing, a tech support scam, a job scam, an SEO cold pitch, invoice phishing with a lookalike domain, and two sneaky ones where the only malicious part was a URL hidden in the client name or the portal name. All blocked, with probabilities between 0.92 and 0.99 after the tuning.

**19 legitimate emails.** Default and customized invitations (with promos, emoji, Spanish copy), invoices, comments, password changes, new requests, expiring cards, a Dropbox link, a comment that mentions a "wallet icon", and a holiday closure notice. All passed.

---

### What It Costs

This is the part that surprised me the most.

Jev costs $0.042 per million input tokens. A typical check is around 500 to 700 tokens. That comes to roughly **$2 to $3 per 100,000 emails**.

Here is how that compares with the alternatives we looked at:

| Option | Price | Per 100k checks | Would it catch our phishing email? |
|---|---|---|---|
| **Jev** | $0.042 per million input tokens | about $2 to $3 | Yes. All 14 spam samples blocked |
| Akismet | $10/month for 10k calls, $50/month for 60k, custom above that | more than $50 | Built for comment and form spam, not tested on this |
| OOPSpam | $49/month for 100k calls | $49 | Same as Akismet |
| Postmark SpamCheck API | Free | $0 | Probably not |
| Postmark itself | No outgoing content filter | n/a | No. It pauses sending after bounces and complaints rise, so only after the emails went out |

Akismet and OOPSpam are good products, but they are built for a different problem: a stranger submitting a form or a comment on your site. They are priced per call and tuned for that kind of content.

Postmark's SpamCheck is free, but it is a SpamAssassin score. It looks at headers, formatting and known spam patterns. Our phishing email came from an authenticated domain with clean, well-formed HTML. It was built to look like a normal transactional email, and to a rule-based scorer, it did.

What we needed was not a spam score. It was a model that understands what a client portal is supposed to send, and notices when an email is asking someone to hand over their password through a link. That is a reading comprehension problem, and it turns out a small classifier solves it for less than a coffee per 100,000 emails.

---

If your users can edit an email your app sends, your app can send phishing. We learned that the hard way.

SPF, DKIM and DMARC tell an inbox who sent an email. They say nothing about what the email says. Checking that part is our job now.

The fix ended up smaller than I expected. One listener, one question, and a model that reads the email the way a person would, for a couple of dollars per 100,000 emails. Most of the work went into explaining to the model what a normal email from our app looks like.

The part I keep thinking about is what kind of tool this is. For years, putting judgment into code meant writing rules: keyword lists, regexes, blocklists of domains, like the ones we still keep for signups. They are cheap and they break the moment someone phrases things differently. A large model could read like a person, but calling one on every email always felt like too much, in cost and in latency. Jev sits right in between. It answers one narrow question with a number, and it is cheap enough to ask on every single event.

That changes which questions are worth asking. Is this comment abusive? Is this new request actually a bug report? Does this upload look like an invoice? Those were features we would never have built, because the rules would be wrong and a big model would cost too much. Now each one is a sentence and a threshold. I suspect the spam filter is only the first one.
