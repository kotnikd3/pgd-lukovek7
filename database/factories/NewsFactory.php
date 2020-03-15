<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\User;
use App\News;

$factory->define(News::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'title' => substr($faker->text, 0, 15),
        'body' => substr($faker->text, 0, 200),
        'type' => collect(News::TYPE)->random()
    ];
});
