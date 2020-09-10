<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => 'Title '. $faker->word(),
        'body' => 'Body '. $faker->text($maxNbChars = 700),
        'category_id' => $faker->numberBetween($min = 1, $max = 10),
        'user_id' => 1,
        'published' => $faker->numberBetween($min = 0, $max = 1)
    ];
});
