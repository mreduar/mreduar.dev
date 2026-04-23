---
extends: _layouts.post
section: content
title: "The Bottleneck Moved"
date: 2026-04-19
description: "Typing was never the skill. It just looked like it because typing was the bottleneck. Now that AI writes the code, what's left is the part that was always hard."
categories: [tips]
---

For years, the hardest part of being a developer was typing. You'd stare at a blank file, load the problem into your head, and grind out a solution one line at a time. That labor was the product. It was also the constraint. How much you shipped came down to how fast you could think in syntax.

That constraint is gone.

Generating code is now the easy half of the job. Models produce it in seconds, at a volume no team could match. Five years ago I would have killed for a tool that turns a paragraph of intent into a working implementation. Today I have one open in a tab next to this post.

So where did the work go?

It moved to the edges.

---

### The Front of the Job

Before any code gets written, someone has to figure out what should actually be built. That part didn't get automated. If anything, it got harder.

You need to shape the problem clearly enough that the model can solve it. You need to feed it enough context so it doesn't hallucinate a function that looks plausible but doesn't belong in your codebase. You need to know when to break a task into smaller pieces and when to hand it over whole.

This used to be a soft skill. Now it's the job.

---

### The Back of the Job

Then there's the other side. The model hands you 200 lines of code. What do you do with them?

You read them. Carefully. Not "scan until nothing looks weird." *Read* them. Does the logic actually match what you asked for? Does it reuse the helpers this codebase already has, or did it invent new ones that duplicate what's already in `app/Services`? Does it handle the weird edge case that only exists because of a bug you fixed last March?

This is where most of the failures happen. And it's the part that looks the most like typing, which is why it keeps getting skipped.

---

### Typing Was Never the Skill

It just looked like it, because typing was the bottleneck. When something is the slowest part of the process, it feels like the important part. Remove it and you finally see what was underneath.

Judgment. Taste. A sense for how systems break.

None of that is new. It was always what separated a useful developer from someone who forwarded Stack Overflow answers into a pull request. The only difference is that the forwarding happens faster now, from a better source, and it's easier than ever to pretend the forwarding is the job.

> It isn't. It never was.
