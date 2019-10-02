<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Models\ExamSession::class, function (Faker $faker) {
    $users = App\User::pluck('id')->toArray();
    return [
        'admin_id' => $faker->randomElement($users),
        'title' => $faker->randomElement(['Final Term','MId Term']),
        'year' => $faker->year
    ];
});
