<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Trip;
use Faker\Generator as Faker;

$factory->define(Trip::class, function (Faker $faker) {
    return [
        "distance"=> $faker->randomFloat(2,1,500),
        'date' => $faker->dateTimeThisYear(),
        "user_id"=> \App\User::all()->random(),
        "car_id" => \App\Car::all()->random()
    ];

//
//    $table->id();
//    $table->timestamps();
//    $table->unsignedDecimal('distance')->default(0);
//    $table->dateTime('date');
//    $table->unsignedInteger('user_id');
//    $table->unsignedBigInteger('car_id');
});
