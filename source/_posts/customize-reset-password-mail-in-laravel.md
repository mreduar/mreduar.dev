---
extends: _layouts.post
section: content
title: "Customize Reset Password Mail in Laravel"
date: 2024-02-28
description: "Laravel provides a simple way to customize the reset password mail. In this article, we will see how to customize the reset password mail in Laravel."
categories: [tips]
---

Recently at my job, we encountered a feature that queues the reset password email, and I decided to create this post to demonstrate how easy it is to implement this and, at the same time, customize the content of the notification itself.

---

Laravel comes with a built-in forgot password feature for the `User` model, which you can find in the authorizable alias that extends to the `User` model. The `User` model has a method to send the notification to reset the password: `sendPasswordResetNotification($token)`. We can override this method to handle our custom messages.

### Creating Our Own Notification

First, we’ll create our own notification that extends from Laravel’s default `ResetPassword` notification.

As the customization I want to do is to queue the Reset Password notification then we need to make our custom notification queue-able.

```bash
php artisan make:notification Auth/QueuedResetPassword
```

This command creates the class `\App\Notifications\Auth\QueuedResetPassword`.

Next we make this class extend the `Illuminate\Auth\Notifications\ResetPassword` class and implement the `Illuminate\Contracts\Queue\ShouldQueue` contract.

Finally we add the `Illuminate\Bus\Queueable` trait to the body of the class.

That is all we need to do to make a new `QueuedResetPassword` notification that is queue-able.

Below is the our final `QueuedResetPassword` notification class:

```php
namespace App\Notifications\Auth;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Auth\Notifications\ResetPassword;

class QueuedResetPassword extends ResetPassword implements ShouldQueue
{
    use Queueable;
}
```

Next, we override the `sendPasswordResetNotification` method in the User model:

```php
use App\Notifications\Auth\QueuedResetPassword;

class User
{
    // ...
    public function sendPasswordResetNotification($token) {
        $this->notify(new QueuedResetPassword($token));
    }
}
```

Make sure to import our custom notification.

### Customizing the Notification Content

Now that we have our custom notification, we can customize the content of the email. We can do this by overriding the `toMail` method in the `QueuedResetPassword` class.

```php
namespace App\Notifications\Auth;

...

class QueuedResetPassword extends ResetPassword implements ShouldQueue
{
    // ...

    public function toMail($notifiable) {
        return (new MailMessage)
            ->subject('Reset Password')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('If you did not request a password reset, no further action is required.');
    }
}
```

This approach allows us to easily queue and customize the reset password email, making the process more adaptable to our specific needs.

I hope this helps you understand how to enqueue and customize the reset password email notification in Laravel!
