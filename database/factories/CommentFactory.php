<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'comment' => 'Comment '. $faker->text($maxNbChars = 200),
        'name' => $faker->name(),
        'email' => $faker->email(),
        'post_id' => rand(1, 20)
    ];
});
