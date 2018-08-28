<?php

use Faker\Generator as Faker;

$factory->define(App\Explanations::class, function (Faker $faker) {
    return [
        'nomination_id' => $faker->numberBetween(1, App\Nominations::count()),
        'explanation' => $faker->paragraph
    ];
});
