---
extends: _layouts.post
section: content
title: "How to Use Bootable Traits in Laravel"
date: 2025-07-06
description: "Learn how to leverage Laravel's bootable traits for automatic attribute encryption and decryption. Complete guide with practical examples and best practices."
categories: [tips]
---

Bootable traits are the stealth feature that lets you share event‑driven behavior across Eloquent models without littering every class with `boot` methods or external observers. Any trait that adds a static `bootTraitName()` hook is automatically executed the moment Laravel initializes the model—no extra wiring required.

Below you'll find a quick refresher on how the mechanism works, followed by a practical example that encrypts sensitive attributes. Swap the encryption logic for anything—audit stamps, geocoding, feature flags—and the pattern stays identical.

---

### Why Bootable Traits Matter

* **Centralized logic** – Ship one trait, attach it to ten models, and Laravel takes care of registering the callbacks.
* **Zero boilerplate** – You skip writing per‑model `saving`, `creating`, or `deleted` listeners.
* **Easily configurable** – Expose an abstract method (e.g., `encryptable()`) so each model declares its own settings.

Under the hood, Eloquent loops through `class_uses_recursive($model)` and calls any `boot{Trait}` static methods it finds. That's the secret sauce that fires your trait code exactly once per request, right after the model's own `boot()`.

You can see this magic happen in Laravel's source code: [Model.php line 347](https://github.com/laravel/framework/blob/e2fdcd734bbf4d7bf254faa17ad8ad601b6aa24b/src/Illuminate/Database/Eloquent/Model.php#L347)

Laravel itself uses bootable traits extensively. The most familiar example is `SoftDeletes`, which implements `bootSoftDeletes()` to automatically add global scopes and handle soft deletion behavior across any model that uses it. You can see this in action: [SoftDeletes.php line 31](https://github.com/laravel/framework/blob/e2fdcd734bbf4d7bf254faa17ad8ad601b6aa24b/src/Illuminate/Database/Eloquent/SoftDeletes.php#L31)

---

### Case Study: `EncryptsAttributes` Trait

Want to keep `api_token` or `secret_key` columns safe? A bootable trait can intercept the **saving** event and transparently run `Crypt::encryptString()`, while providing an opt‑in helper for decrypting on demand.

```php
<?php
namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait EncryptsAttributes
{
    /**
     * Auto‑encrypt configured attributes just before the model is persisted.
     * 
     * @return void
     */
    public static function bootEncryptsAttributes(): void
    {
        static::saving(function ($model) {
            foreach ($model->encryptable() as $key) {
                if (! is_null($model->{$key})) {
                    $model->{$key} = Crypt::encryptString($model->{$key});
                }
            }
        });
    }

    /**
     * Models must declare which columns need encryption.
     * 
     * @return array<string>
     */
    abstract public function encryptable(): array;

    /**
     * Manual decrypt helper for occasional plaintext access.
     * 
     * @param  string  $key
     * @return string|null
     */
    public function decryptAttribute(string $key): ?string
    {
        return is_null($this->{$key})
            ? null
            : Crypt::decryptString($this->{$key});
    }
}
```

---

### Attaching the Trait to a Model

```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EncryptsAttributes;

class ApiCredential extends Model
{
    use EncryptsAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'api_token', 'secret_key'];

    /**
     * Tell the trait which columns to protect.
     * 
     * @return array<string>
     */
    public function encryptable(): array
    {
        return ['api_token', 'secret_key'];
    }
}
```

That's it—no per‑model observers, no duplicated callbacks. When you `create()` or `update()` an `ApiCredential`, the sensitive fields are encrypted before hitting the database.

---

### Reading Plaintext Safely

Need the raw token inside a service? Call:

```php
$plain = $credential->decryptAttribute('api_token');
```

Limit plaintext exposure—decrypt only inside trusted services, not in blade views that might leak logs.

---

### Why the Pattern Scales

* **Plug‑and‑play** – Drop the trait into any project; it relies solely on core Eloquent events.
* **Config‑driven** – Each model lists its own attributes, keeping the trait generic.
* **Single maintenance point** – Rotate keys or switch encryption algorithms once, and every model benefits.
* **Testable** – Unit‑test the trait in isolation, then assert encrypted blobs in the database.

---

### Extending the Idea

Bootable traits aren't limited to encryption. Use the exact same scaffold to:

* **Auto‑generate slugs** – Create URL‑friendly slugs from a model's `title` or `name` attribute before saving.
* **Log user activities** – Track who created, updated, or deleted records with automatic `created_by`, `updated_by` fields.
* **Add tenant scoping** – Inject a `tenant_id` global scope in multi‑tenant SaaS applications.
* **Push audit records** – Send change logs to an outbox table on every update for compliance tracking.
* **Geocode addresses** – Automatically convert addresses to `lat`/`lng` coordinates before save.
* **Set timestamps** – Add custom timestamp fields like `published_at` or `processed_at` based on model state.
* **Generate UUIDs** – Auto‑assign unique identifiers to models that need them.
* **Cache invalidation** – Clear related cache keys whenever a model changes.

If the logic belongs on **every** instance of a given model class, a bootable trait is often clearer than a universal observer.
