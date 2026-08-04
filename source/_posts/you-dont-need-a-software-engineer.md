---
extends: _layouts.post
section: content
title: "You Don't Need a Software Engineer"
date: 2026-08-04
description: "Someone asked me if you can build an app without hiring a software engineer. Absolutely you can. Here is the short list of what you have to handle first."
categories: [opinion]
---

Someone asked me the other day whether you can build an app without hiring a software engineer.

Yes. Absolutely. AI can do it. You can do it yourself this weekend.

You just have to handle a few small things first.

---

### Start With the Easy Part

You simply define the functional requirements. Then the non functional ones, which is where you decide how fast is fast enough and how broken is too broken.

Then you pick a language. Then a framework. Then you design the system architecture, because the framework will not do that for you no matter how confidently it suggests otherwise.

Then you build the frontend. Then the backend. Then you design the API, which mostly means deciding what the frontend and the backend have agreed to lie to each other about.

Then you model the database. Migrations, indexes, relationships, integrity constraints. The indexes only matter later, once there are enough rows for the app to get slow, which is also the exact moment you will not have time to add them.

Nothing complicated so far.

---

### Then You Just Add Users

Because an app with no users is not really an app.

So you implement authentication. Then authorization, which is a different thing, and the difference is the part everyone gets wrong. Then session handling. Then password recovery, which is an entire feature pretending to be a link in an email.

Then secure credential storage. Then encryption for sensitive data. Then input validation, on the server, because the client side validation you already wrote is a suggestion.

Then protection against SQL injection, XSS, CSRF, and the rest of a list that has been public, documented and explained for twenty years, and still ships to production every single day.

Simple stuff. Moving on.

---

### Now You Just Put It Online

You simply configure the servers. Cloud infrastructure. Networking. DNS. Domains. SSL certificates, which expire quietly, on a Saturday.

Load balancers. Firewall rules. Backup storage, plus the part everyone skips, which is verifying that the backups actually restore.

Redundancy. Disaster recovery. Horizontal scaling. Vertical scaling. Caching, and then cache invalidation, which is famously one of the two hard problems in this field.

Queues. Background jobs. Retries for the background jobs. Dead letter handling for the retries.

Almost done.

---

### And Naturally, the Environments

Development, staging, production. Environment variables for each. Credentials. Secrets management, so those credentials do not end up in the repo, where they live forever, including after you delete them.

Continuous integration. Continuous deployment. Version control, with a branching strategy your future self can still follow.

Unit tests. Integration tests. End to end tests. Load tests, so you find out where it breaks before your users do it for you, for free, in public.

---

### Then You Just Watch It

Logging. Monitoring. Metrics. Alerts. Tracing. Error tracking. Observability in general.

All of that exists so you find out the app went down before your users tell you. Which is the entire difference between an incident and a reputation.

---

### If You Take Payments

Payment gateway integration. Webhooks. Idempotency, so a retried webhook does not charge someone twice. Or refund them twice, which is worse, and somehow more common.

Reconciliation. Refunds. Failed transaction handling. And chargebacks, eventually, from someone who forgot they subscribed.

---

### If You Send Email

You configure the email provider. Then SPF. Then DKIM. Then DMARC.

You configure all three so your password reset emails land in the inbox instead of spam, where nobody finds them, and where they turn into support tickets that you also have to answer.

---

### If It Is a Mobile App

Certificates. Provisioning profiles. Signing. Builds. Version management.

Privacy policies. Review processes on Google Play and the App Store, run by people who have opinions and no obligation to explain them.

---

### And Then the Rest

Performance. Device compatibility. Accessibility. Analytics. Privacy. Personal data protection. Terms and conditions.

Dependency updates. Third party vulnerabilities. Infrastructure costs, which are small right up until the month they are not.

---

### Six Months Later

And if you keep all of that running while people are actually using it. While the requirements change. While bugs appear in the paths you were sure nobody would take. While operating systems update. While a third party deprecates the endpoint your whole flow was built on.

And while some dependency you have not touched in six months decides, on its own, on a Tuesday, to stop working.

Then yes.

> You do not need a software engineer. Not at all.
