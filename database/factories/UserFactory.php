<?php

use App\Models\User;
use Faker\Generator as Faker;

// Генерация пользователя
$factory->define(User::class, function (Faker $faker) {
    return [
        'name'    => $faker->name,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt($faker->password())
    ];
});
