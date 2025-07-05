---
extends: _layouts.post
section: content
title: Server-Side Geolocation Filtering in Laravel with the Haversine Formula
date: 2025-07-05
description: Learn how to implement distance-aware queries in Laravel using the Haversine formula. Perfect for location-based features like finding nearby drivers, stores, or events.
categories: [tips]
cover_image: /assets/img/posts/server-side-geolocation-filtering-laravel-haversine.png
---

Distance-aware queries are a core feature for modern apps—whether you're matching riders and drivers, showing events around a user, or surfacing the nearest warehouses for same-day delivery. The fastest, most accurate way to deliver those results is to compute great-circle distance inside your SQL engine with the Haversine formula, then let Eloquent give you a fluent, testable API.

Below you'll find a drop-in scope that mirrors the code sample you shared, plus clear guidance on modelling, relationships, and performance.

### Why Haversine?

**Mathematically sound.** Haversine treats Earth as a sphere, producing realistic distances at planetary scale without the overhead of full ellipsoidal calculations.

**Pushes work to the DB.** The heavy trig runs where your data already lives, slicing result sets before PHP ever sees them.

**Vendor-agnostic.** Works in MySQL, MariaDB, Postgres, SQL Server—anything that supports basic trig functions.

### The Math — Haversine Engine, No Mystery

The **Haversine formula** gives the great-circle distance between two points on a sphere:

<div class="math display-math">
d = 2r \arcsin\left(\sqrt{\sin^2\left(\frac{\Delta\varphi}{2}\right) + \cos\varphi_1 \cos\varphi_2 \sin^2\left(\frac{\Delta\lambda}{2}\right)}\right)
</div>

**Where:**

- <span class="math">r</span> is the Earth's radius (≈ <span class="math">6{,}371\text{ km}</span> or <span class="math">3{,}959\text{ mi}</span>)
- <span class="math">\Delta\varphi = \varphi_2 - \varphi_1</span> is the difference in latitude (radians)
- <span class="math">\Delta\lambda = \lambda_2 - \lambda_1</span> is the difference in longitude (radians)
- <span class="math">\varphi_1, \varphi_2</span> are the latitudes of the two points
- <span class="math">\lambda_1, \lambda_2</span> are the longitudes of the two points

Plugging those values in returns the shortest surface distance (the **great-circle distance**)—ideal for any geospatial filter you need on the server.

### The Data Model

We'll generalise first and then pivot to a concrete example:

| Table | Purpose | Key Columns |
|-------|---------|-------------|
| `trips` (or any parent entity) | The object you're filtering **from** | `id`, … |
| `coordinates` | Latitude/longitude pairs representing nearby entities (cars, stores, users, etc.) | `id`, `latitude`, `longitude`, `trip_id` |

`Trip` ➜ hasMany ➜ `Coordinate`  
`Coordinate` ➜ belongsTo ➜ `Trip`

> You can just as easily embed `latitude` and `longitude` directly on the primary model. The scope below works in either scenario; choosing a relation simply keeps the example laser-focused on nearest cars for a given trip.

### The Scope

```php
/**
 * Scope a query to include only records within a given radius.
 *
 * @param  \Illuminate\Database\Eloquent\Builder  $query
 * @param  float|int  $distance
 * @param  float  $lat
 * @param  float  $lng
 * @param  string  $units
 * @return \Illuminate\Database\Eloquent\Builder
 */
public static function scopeByDistance(
    $query,
    $distance,
    $lat,
    $lng,
    string $units = 'kilometers'
) {
    $query->when($distance && $lat && $lng, function ($query) use ($lat, $lng, $units, $distance) {
        // Decide Earth-radius constant
        $greatCircleRadius = match ($units) {
            'miles' => 3959,  // mi
            'kilometers', default => 6371,  // km
        };

        // Haversine select expression
        $haversine = sprintf(
            'ROUND(( %d * ACOS( COS( RADIANS(%s) ) ' .
            '* COS( RADIANS( latitude ) ) ' .
            '* COS( RADIANS( longitude ) - RADIANS(%s) ) ' .
            '+ SIN( RADIANS(%s) ) * SIN( RADIANS( latitude ) ) ) ), 2) AS distance',
            $greatCircleRadius,
            $lat,
            $lng,
            $lat
        );

        // Filter through the coordinates relation
        $query->whereHas('coordinates', fn ($coordinate) => $coordinate
            ->select(DB::raw($haversine))
            ->having('distance', '<=', $distance)
            ->orderBy('distance', 'ASC')
        );
    });

    return $query;
}
```

**Decisive details:**

- **Units are explicit.** No hidden constants—callers pass `'miles'` or `'kilometers'`.
- **Select + having.** We compute distance and filter in one trip to the database.
- **Relation-aware.** `whereHas` ensures we only pull `Trip` rows that have at least one qualifying `Coordinate`.

### Practical Example: Finding Cars Near a Trip

```php
$nearbyCars = Trip::byDistance(
        distance: 10, // 10 km radius
        lat: $trip->pickup_lat,
        lng: $trip->pickup_lng,
        units: 'kilometers'
    )
    ->with('coordinates') // eager-load matches
    ->get();
```

Swap `Trip` and `Coordinate` for any other domain pair—warehouses and parcels, events and attendees, sellers and buyers.

### If You Store Lat/Lng on the Same Table

Just remove the `whereHas` wrapper and call `selectRaw` / `having` directly on `$query`. Everything else remains identical.

```php
$query->selectRaw($haversine)
      ->having('distance', '<=', $distance)
      ->orderBy('distance');
```

### Performance Power-Ups

| Technique | Why It Matters |
|-----------|----------------|
| Composite index on `(latitude, longitude)` | Accelerates simple bounding-box prefilters. |
| Bounding box guard-clause | `whereBetween` lat/lng to skip obvious misses before running trig. |
| Spatial columns | `POINT` + `SPATIAL INDEX` (MySQL) or PostGIS geography types let you switch to `ST_DistanceSphere` later with a one-liner. |
| Query caching | City-scale apps see repetitive origins—cache JSON responses for 30–60 s. |

### Testing the Scope

```php
test('returns coordinates within radius', function () {
    $origin = ['lat' => 10.5000, 'lng' => -66.9167];

    Coordinate::factory()->create(['latitude' => 10.51, 'longitude' => -66.91]); // ~1 km
    Coordinate::factory()->create(['latitude' => 11.00, 'longitude' => -67.00]); // ~70 km

    $results = Trip::byDistance(5, $origin['lat'], $origin['lng'])->get();

    expect($results)->toHaveCount(1);
});
```

Fast, deterministic, no external APIs.

### Final Thoughts

The Haversine formula is universally applicable—anywhere you need "X within Y km". By embedding it in a concise Eloquent scope, you gain:

- **Zero vendor lock-in.** Works the same across MySQL, MariaDB, Postgres, or SQL Server.
- **Uncompromising performance.** The database filters; PHP just maps results to resources.
- **Readable, testable code.** Your controllers stay slim, your models self-document intent.

Copy the scope, adjust the relationship (or not), and ship precise geospatial queries!.