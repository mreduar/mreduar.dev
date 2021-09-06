---
extends: _layouts.post
section: content
title: Avoiding the N+1 problem in Laravel
date: 2020-09-02
description: How you can avoid loops by using collections. It sounds great from the beginning but you need to practice it in order to be able to use it in your own projects..
categories: [tips]
---

Let's do some piggybacking on our code from [Tip #1](/blog/refactoring-to-collections).

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

Note how we fetch the User model for a given participant in the average function. This is highly problematic, because we're doing an additional SQL query "behind the scenes" by loading many users models one at a time.

A better solution for this would be to eager load them on our first query. When we do that, we can reduce the number considerably, instead of having N+1 queries (hence the name of that dreaded issue).

It is easy to do this with the with method of eloquent. Let's refactor the code above:

```php
<?php

public function usersAverageScore() {
    $participants = $this->participants()->with('user')->get();

    return $participants->filter(function ($participant) {
        return $participant->isActive();
    })->average(function ($participant) {
        return $participant->user->averageMessages();
    });
}
```

Now, whenever we call `$participant->user->averageMessages()`, the user model related to the participant was already cached during our first call ($this->participants()).

(By the way, there's still one non-optimized call related to this tip in the code above - can you spot it? Leave it in the comments).

This is a problem that has been discussed by many Laravel developers for some time now. However I will give another example here so that you can imagine another situation.

Preventing lazy loading in development can help you catch N+1 bugs earlier on in the development process. The Laravel ecosystem has various tools to identify N+1 queries. However, this approach brings the issue front-and-center by throwing an exception.

Recently this year [Mohamed Said](https://twitter.com/themsaid) has contributed a new feature that avoids this behavior in the first place and prevents this error from occurring in an application under development.

Open up the `AppServiceProvider` class and add the following to the `boot()` method:

```php
// app/Providers/AppServiceProvider.php

public function boot()
{
    Model::preventLazyLoading(! app()->isProduction());
}
```
This will only prevent this behavior in non-productive environments.

If you run a `php artisan tinker` session, you should get an exception for a lazy loading violation:

```php
>>> $participants = $this->participants;
>>> $participants[0]->user
Illuminate\Database\LazyLoadingViolationException with message
'Attempted to lazy load [user] on model [App\Models\Participant] but lazy loading is disabled.'
```

You can learn how this feature was implemented: [8.x Add eloquent strict loading mode - Pull Request #37363](https://github.com/laravel/framework/pull/37363). Huge thanks to [Mohamed Said](https://twitter.com/themsaid), contributors, and of course Taylor Otwell for adding [the polish](https://github.com/laravel/framework/pull/37363#issuecomment-844358540) to disable lazy loading conditionally.
