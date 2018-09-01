<?php

use Faker\Generator as Faker;

$factory->define(App\AwardForward::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, App\User::count()),
        'nominee' => $faker->name,
        'description' => $faker->paragraph
    ];
});
