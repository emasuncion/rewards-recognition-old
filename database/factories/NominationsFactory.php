<?php

use Faker\Generator as Faker;

$factory->define(App\Nominations::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, App\User::count()),
        'nominee' => $faker->name,
        'category' => $faker->numberBetween(1, App\Category::count()),
        // 'explanation' => $faker->paragraph,
        'quarter' => $faker->numberBetween(1, App\Quarter::count()),
    ];
});
