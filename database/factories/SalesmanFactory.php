<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Salesman;
use Faker\Generator as Faker;

$factory->define(Salesman::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
    ];
});
