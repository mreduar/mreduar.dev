---
extends: _layouts.post
section: content
title: How to Stream Large File Uploads to AWS S3 in Laravel
date: 2025-07-05
description: Learn how to handle multi-gigabyte uploads in Laravel by streaming files directly to AWS S3 using S3M. Complete with Vue.js examples and best practices.
categories: [tips]
---

Handling multi‑gigabyte uploads in a stateless app is painful: TCP throughput caps slow single‑request uploads, server disks fill, and Lambda containers vanish between requests. Modern teams therefore push the heavy bits straight from the browser to Amazon S3. **S3M**—a lean wrapper around S3's multipart and presigned‑URL APIs—removes the boilerplate. S3M works with any JavaScript front‑end, but in this post **I'll give you some examples using Vue** so you can see the flow end‑to‑end without locking you into a specific framework.

### Why multipart + presigned URLs?

Amazon limits a single `PUT` to 5 GB. Multipart uploads slice the object, let slices fly in parallel, and re‑assemble the completed object inside S3. Presigned URLs add a time‑boxed signature, allowing the browser to upload directly to S3 while your API remains stateless and credential‑free. In practice the flow has four distinct calls: *initiate*, *sign*, *upload parts*, *complete*.

### Prerequisites

* **Laravel 10 or newer** with an `s3` disk configured in `config/filesystems.php`.
* **AWS** IAM user or role able to call `s3:PutObject`, `s3:AbortMultipartUpload`, `s3:CompleteMultipartUpload`, and `s3:ListMultipartUploadParts`.
* **Front‑end**: any framework (React, Vue, Alpine, plain JS). The snippets below use Vue for clarity.
* Composer & Node.

### 1 – Install the helper

```bash
composer require mreduar/s3m
```

Add the Blade directive before your compiled JS so the global `s3m()` helper is injected:

```blade
{{-- resources/views/layouts/app.blade.php --}}
<!doctype html>
<html>
  <head>
      @s3m   {{-- pushes the small JS bridge into the page --}}
      @vite('resources/js/app.js')
  </head>
  <body class="antialiased">
      @yield('content')
  </body>
</html>
```

The directive publishes a 3‑kB script that negotiates presigned URLs when you call `s3m(file, options)` on the client.

### 2 – Publish and tweak config

```bash
php artisan vendor:publish --provider="MrEduar\S3M\S3MServiceProvider"
```

`config/s3m.php` exposes sensible defaults—10 MB chunks, four parallel PUTs, three automatic retries per part. When your audience has slow upstream links, dial the `part_size` down (the minimum is 5 MB except for the last part) to shorten retry times.

### 3 – Gate uploads with a policy

S3M calls Laravel's authorization layer before handing out any presigned URLs. Create a policy if you don't already have one:

```bash
php artisan make:policy UserPolicy --model=User
```

```php
public function uploadFiles(User $user): bool
{
    return $user->plan()->allows('large_upload');
}
```

This guarantees that an attacker can't obtain a signed URL unless the current user meets your business rules.

### 4 – Expose a controller endpoint

While S3M can wire routes for you, most teams prefer an explicit controller to attach domain metadata:

```php
Route::post('/api/profile-photo', ProfilePhotoController::class);
```

Inside you can move the temporary object out of `tmp/` after the browser confirms completion:

```php
Storage::copy($request->key, Str::after($request->key, 'tmp/'));
```

You now hold the stable S3 key that maps to the uploaded file.

### 5 – Front‑end example (Vue)

The helper works with any framework; swap the snippet for React, Alpine, or vanilla JS as needed. Below is a Vue Composition‑API component that streams the selected file:

```vue
<script setup>
import { ref } from 'vue'
import axios from 'axios'

const progress = ref(0)

function upload(e) {
  const file = e.target.files[0]

  s3m(file, {
    progress: p => progress.value = p
  }).then(({ uuid, key, bucket }) => axios.post('/api/profile-photo', {
      uuid, key, bucket,
      name: file.name,
      content_type: file.type,
  }))
}
</script>

<template>
  <input type="file" @change="upload" />
  <progress :value="progress" max="100" class="w-full" />
</template>
```

Under the hood `s3m()` performs **initiate → get signed parts → parallel `PUT`s → complete** in fewer than 150 lines of unobtrusive JavaScript.

### 6 – Make the upload permanent

Every object lands in `tmp/` so abandoned uploads can be purged by an S3 lifecycle rule after 24 h. A service class might promote the file once your app accepts it:

```php
public function promote(string $key): string
{
    $finalKey = Str::after($key, 'tmp/')
    Storage::disk('s3')->copy($key, $finalKey);
    return $finalKey; // stable key without the tmp/ prefix
}
```

### Pro tips for production

* **Chunk size trade‑offs** – parts must be at least 5 MB (except the last). Aim for 8–15 MB to balance retry latency and TLS overhead.
* **Transfer Acceleration** – If users upload from distant regions, enabling S3 Transfer Acceleration routes traffic through the nearest CloudFront edge and can shave seconds off large uploads.
* **CORS headers** – Expose `ETag` and allow `PUT`, `POST`, `GET`, `HEAD` so the browser can send part signatures back during completion.
* **Observability** – Log the `UploadId`, part numbers, and user ID; correlating failures in CloudWatch or Kibana becomes trivial.

### Closing thoughts

With S3M you glue a single Blade directive on the front end and one controller on the back end, yet you gain a resumable, parallel‑chunked upload pipeline that never blocks PHP workers and never exposes AWS credentials to the client. Adapt the Vue snippet to any framework—or even plain JavaScript—and you'll stream large files to S3 with confidence.