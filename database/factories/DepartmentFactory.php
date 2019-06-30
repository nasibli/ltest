<?php

use App\Models\Department;
use Faker\Generator as Faker;

// Генерация отдела
$factory->define(Department::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->realText()
    ];
});
