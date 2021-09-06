---
extends: _layouts.post
section: content
title: Refactoring to Laravel Collections
date: 2020-08-31
description: How you can avoid loops by using collections. It sounds great from the beginning but you need to practice it in order to be able to use it in your own projects..
categories: [tips]
---

How you can avoid loops by using collections. It sounds great from the beginning but you need to practice it in order to be able to use it in your own projects..

Imagine you are developing a web site in which users participate in threads and are ranked in a top each week, and your job is to show other users the current average score of a specific thread, effectively rating how many posts each participant in a thread sends, in order to know which thread is the most active of all.

You can come up with a model like this:

```php
<?php

class Thread extends Model{
    /** ... code omitted for brevity **/

    public function participantAverageMessages() {
        $participants = $this->participants;

        $sum = 0;
        $activeParticipants = 0;
        foreach($participants as $participant) {
            if ($participant->isActive()) {
                $activeParticipants++;
                $sum += $participant->user->averageMessages();
            }
        }

        return $sum / $activeParticipants;
    }

}
```

Our method `participantAverageMessages()` seems to work quite nicely. We loop through our participants, check if the participant is a active user and we keep summing up their last ratings average messages (the average of each criteria in a given rating).

The issue here is that if someone has to come back to this method later for a bugfix or a changed requirement, your teammate (or even yourself) is going to "compile" this `foreach` in his head before doing anything. Loops are generic and, in the case of this one, we do multiple things in each pass: we check if they're a user and then add it to a sum that we only deal again in the return statement.

Of course, this is a relatively simple example, but imagine if we did more? What if we wanted to filter this to only **some** users or add different weights to each one? Maybe consider all their messages, not only of the current thread? This could get out of hand quickly.

So how can we express these checks and calculations better? More semantically? Fortunately, we can use a bit of functional programming with the methods that Eloquent gives us.

Instead of checking manually if a given participant is a user, using the `filter` method can return only the users for us:

```php
<?php

public function participantAverageMessages() {
    $participants = $this->participants;

    $participants->filter(function ($participant) {
        return $participant->isActive();
    });
}
```

Using the `filter` function, we can just pass a function as an argument to return only the participants that fulfill our condition. In this case, this call will return a subset of `$participants`: only the users.

Naturally, we also need to finish this by calculating their average score. Should we do a `foreach` now? It would still be suboptimal. There's a built-in solution in another function, conveniently called `average`, in our returned Eloquent collection. It follows rules similar to `filter`, where we just return which value we want to average from the whole colllection. The final code looks like this:

```php
<?php

public function usersAverageScore() {
    $participants = $this->participants;

    return $participants->filter(function ($participant) {
        return $participant->isActive();
    })->average(function ($participant) {
        return $participant->user->averageMessages();
    });
}
```

Since `average` returns a number, this is exactly what we want. Pay attention how we **chained** our calls, and how much better the code looks. You can almost read it like a natural language: Get the participants filtered by who is a user, then average their last rating's score and return the value. The intention of our code is cleare and our code, cleaner and more semantic.

This applies not only to PHP or Eloquent, really - you can do similar things with javascript. It's out of the scope of this article, but if you never heard of filter, map and reduce in the context of javascript, go check it out.

This has only been a small example of a very bad code to a moderately good code. However, it can be improved a lot more, for example getting the average directly from the database or getting the active participants directly from the database.

In [the following post](/blog/avoiding-the-n-1-problem) I will explain you how to avoid the N+1 problem that is very common to make this mistake when you are starting with Laravel, in our example the N+1 problem occurs when calling `$participant->user->averageMessages()`.
