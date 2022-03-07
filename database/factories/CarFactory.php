<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use Faker\Generator as Faker;

$factory->define(Car::class, function (Faker $faker) {

    $user = \App\User::all()->random();

    return [
        "brand" => $faker->unique()->word(),
        "model" => $faker->unique()->word(),
        "year" => $faker->dateTimeThisYear()->format('Y'),
        "user_id" => $user->id
    ];
});
