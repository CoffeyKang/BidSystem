<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => Str::random(4),
        'min_price' => $faker->numberBetween(1, 100),
        'category_id' => 1,
    ];
});
