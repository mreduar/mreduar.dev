---
extends: _layouts.post
section: content
title: Refactoring to whereRelation method
date: 2021-09-07
description: How you can avoid loops by using collections. It sounds great from the beginning but you need to practice it in order to be able to use it in your own projects..
categories: [tips, refactoring]
---

Previously in Laravel when you wanted to get a relation and include an extra complex condition you had to do it with the `whereHas` method in the following way:

```php
// Get me all users who have posts that are to be published in the future.
User::whereHas('posts', function ($query) {
    $query->where('published_at', '>', now());
})->get();
```

Recently [DarkGhostHunter](https://github.com/DarkGhostHunter) has made a [PR in Laravel 8.57.0](https://github.com/laravel/framework/pull/38499) version where it is possible to simplify this in a much more elegant and polished way.

```php
User::whereRelation('posts', 'published_at', '>', now())->get();
```

As you can see, we have collapsed the closure into the parameter list of the whereRelation method.

With this PR, you also have access to `whereRelation` and `orWhereRelation` helpers, and `whereMorphRelation` and `orWhereMorphRelation` for morph relations. Since these use the `where` method underneath, you can do advanced things:

```php
Comment::whereMorphRelation('commentable', '*', [
    'is_public' => true,
    'is_vip' => false,
])->get();
```
### What cannot be done

However, it also becomes a disadvantage, since you will not be able to use scopes inside as you used to do with `whereHas`, for example you will not be able to make

```php
Post::whereHas('comments', function ($comment) {
    $comment->approved();
})->get();
```

Or nested where:
```php
User::whereHas('posts', function ($post) {
    $post->whereHas('tags', function ($tag) {
        $tag->where('name', 'tips');
    })->where('published_at', '>', now());
})->get();
```

---

This is an improvement that many of us will appreciate very much and that will serve us in the day to day to have a more elegant code without a doubt.
