---
extends: _layouts.post
section: content
title: "Discovering Laravel Latest Eloquent Methods: whereAll & whereAny"
date: 2024-03-17
description: "Laravel 8.57.0 has introduced two new methods to the Eloquent Builder: whereAll and whereAny. These methods allow you to filter a relationship based on multiple conditions."
categories: [tips, refactoring]
---

In the ever-evolving world of web development, Laravel continues to introduce features that simplify and enhance the coding experience. The recent [Laravel 10.47](https://github.com/laravel/framework/releases/tag/v10.47.0) update has brought us two innovative Eloquent methods that streamline database queries, especially when it comes to searching for data. Let’s dive into these methods and see how they can benefit your projects.

Traditionally, when implementing a search functionality in a Laravel application, you might find yourself writing lengthy queries to match various attributes. For instance, searching for orders by email or name would look something like this:

```php
// Traditional search query
$orders->where('email', 'like', "%$search%")[^1^][1]
       ->where('name', 'like', "%$search%");
```

### WhereAll Method

With the introduction of the `whereAll` method, you can now condense this query into a more elegant and readable form:

```php
// Simplified with whereAll
$orders->whereAll(['email', 'name'], 'like', "%$search%");[^1^][1]
```

This method generates a query that ensures all specified columns match the given criteria, making your code cleaner and more efficient.

### WhereAny Method

On the other hand, the `whereAny` method offers flexibility by allowing any of the specified columns to match the criteria:

```php
// Flexible with whereAny
$orders->whereAny(['email', 'name'], 'like', "%$search%");[^1^][1]
```

This results in a query that matches records if any of the columns meet the search term, perfect for broader search functionalities.

These methods not only make your codebase more maintainable but also enhance the readability and scalability of your applications. Embrace these new additions to the Laravel toolkit and watch your productivity soar!
