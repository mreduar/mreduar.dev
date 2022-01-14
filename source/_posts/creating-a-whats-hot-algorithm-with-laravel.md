---
extends: _layouts.post
section: content
title: Creating a "what's hot" Reddit algorithm with Laravel
date: 2022-01-09
description: This is a small guide on how to implement a Reddit-style "what's hot" algorithm with Laravel Framework.
categories: [tips, tutorials, mysql]
featured: true
cover_image: /assets/img/posts/creating-a-whats-hot-algorithm-with-laravel.png
---

This is a small guide on how to implement a Reddit-style "what's hot" algorithm with Laravel Frameowrk.

There are two primary benefits to using a "what's hot" algorithm.

- It gives newer posts a chance. The problem with many "most popular" pages is that they give older posts and items a huge advantage over their younger counterparts. This leads to a situation where superior content is losing out to mediocre content that was created months beforehand.
- It keeps things "fresh" and prevents content stagnation. Most users will quickly lose interest in a website that only displays a "most popular" list. This is because the content does not change enough to warrant any kind of long-term attention.

For this example, we are going to assume that we are running a website that provides users with the functionality to "thumbs up" or "thumbs down" videos that have been submitted.

### Our table design.

Note that I am going to try to keep our database design as simple as possible, lest we allow other topics to creep into the article. Here is the structure of an example table. Note that the three columns that are most important to us are "thumbs_up", "thumbs_down" and "created_at" Without these columns, we cannot implement a "what's hot" page:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->smallInteger('thumbs_up');
            $table->smallInteger('thumbs_down');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
```

### Our SQL query.

Personally, I think that it is better to implement the "what's hot" algorithm in SQL, and not in Laravel directly. i.e. Let the database handle the heavy work. This is because:

1. It allows us to avail of any indexes that we created.
2. We can cache the results of the query in memory if we need to.

The query looks like this (based on the Reddit algorithm):

```php
Video::orderByRaw('
    LOG10(ABS(thumbs_up - thumbs_down) + 1) *
    SIGN(thumbs_up - thumbs_down) +
    (UNIX_TIMESTAMP(created_at) / 300000) DESC
')->limit(100)->get();
```
As you can see, the algorithm is implemented in the `orderByRaw` method and we've limited the results to 100.
Let's explain a little bit how the sorting algorithm works.

- First, we use `LOG10()` to obtain the logarithm of the absolute value of the difference between `thumbs_up` and `thumbs_down`. This is because we want to sort the videos by their "hotness" score (i.e. how popular they are).
- The "hotness" score is calculated by taking the logarithm of the absolute value of the difference between `thumbs_up` and `thumbs_down`. The sign of the difference is used to determine whether `thumbs_up` or `thumbs_down` is the most popular.
- The `UNIX_TIMESTAMP()` function is used to determine the age of the video. Since `UNIX_TIMESTAMP(created_at)` will give a very large number (seconds elapsed since January 1st, 1970) adding the other operations will mean nothing, so it is divided by 300000 to make the age of the video more meaningful in the equation, It could also be useful to multiply `thumbs_up` and `thumbs_down` by a large number such as 86400 which is the multiplication of 24 hours * 60 minutes * 60 seconds. This is because videos created less than a minute ago are more significant than videos created more than a minute ago.
- Finally, we use the `SIGN()` function to determine whether `thumbs_up` or `thumbs_down` is the most popular.


Let's quickly create a seeder together with a factory to fill our video table:

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'url' => $this->faker->url,
            'thumbs_up' => $this->faker->numberBetween(0, 120),
            'thumbs_down' => $this->faker->numberBetween(0, 120),
        ];
    }
}
```

```php
<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::factory()->count(50)->create();
    }
}
```

After adding a few videos to your table and running the "what's hot" query above, you'll see that a row's total score does not guarantee it the top spot. Instead, our algorithm takes both the record's total score and its creation time into account.

Here is a result obtained in tinker for me (I am using the "what's hot" algorithm):

```bash
[!] Aliasing 'Video' to 'App\Models\Video' for this Tinker session.
=> Illuminate\Database\Eloquent\Collection {#1375
     all: [
       App\Models\Video {#1743
         id: 33,
         title: "Voluptatibus autem similique et accusantium eos.",
         url: "http://walter.com/sequi-ea-veritatis-est-laudantium-alias-numquam-voluptates",
         thumbs_up: 56,
         thumbs_down: 3,
         created_at: "2022-01-09 14:03:47",
         updated_at: "2022-01-09 22:13:55",
       },
       App\Models\Video {#1990
         id: 35,
         title: "Numquam molestias sapiente quo corrupti nemo fuga.",
         url: "http://littel.org/et-facilis-voluptas-rerum",
         thumbs_up: 76,
         thumbs_down: 28,
         created_at: "2022-01-09 23:13:14",
         updated_at: "2022-01-09 22:13:55",
       },
       App\Models\Video {#1991
         id: 2,
         title: "Rem sit explicabo harum.",
         url: "https://www.lang.com/ratione-quia-non-commodi-labore-occaecati-non",
         thumbs_up: 88,
         thumbs_down: 59,
         created_at: "2022-01-08 05:09:10",
         updated_at: "2022-01-09 22:13:55",
       },
       App\Models\Video {#1992
         id: 43,
         title: "Minus fugit culpa ut necessitatibus tenetur non.",
         url: "http://www.ernser.com/",
         thumbs_up: 51,
         thumbs_down: 36,
         created_at: "2022-01-08 04:17:35",
         updated_at: "2022-01-09 22:13:55",
       },
       App\Models\Video {#1993
         id: 23,
         title: "Tempora voluptatibus consequatur numquam sequi autem similique voluptatum.",
         url: "http://friesen.info/",
         thumbs_up: 93,
         thumbs_down: 8,
         created_at: "2022-01-04 23:29:15",
         updated_at: "2022-01-09 22:13:55",
       },
     ],
   }
```
If you want to get the source code for this example you can find it here.
https://github.com/mreduar/whats-hot-algorithm-with-laravel

### Extra Pointers.
- Your vote buttons should send off an Ajax request instead of redirecting the user or reloading the page. Websites like Youtube and Reddit have conditioned users to believe that their vote is in “real time.” Sending Ajax requests is extremely easy with JavaScript libraries such as axios.
- If performance is a concern, be sure to read up on [indexes](https://dev.mysql.com/doc/refman/5.7/en/mysql-indexes.html). You might also want to look into the possibility of using an [object caching daemon](https://laravel.com/docs/8.x/cache) such as [Memcached](https://memcached.org/) or [Redis](https://redis.io/).
- To prevent the user from voting multiple times, you should store votes against the User's ID. There are other methods of preventing vote rigging, but they fall outside the scope of this article.


If you have any questions or concerns, feel free to post them in the comment section below.


