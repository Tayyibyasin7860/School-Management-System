<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Exam::class, function (Faker $faker) {
    $exam_sessions = App\Models\ExamSession::pluck('id')->toArray();
    $classes = App\Models\ClassRoom::pluck('id')->toArray();
    $subjects = App\Models\Subject::pluck('id')->toArray();
    return [
        'exam_session_id' => $faker->randomElement($exam_sessions),
        'class_id' => $faker->randomElement($classes),
        'subject_id' => $faker->randomElement($subjects),
        'date' => $faker->date,
    ];
});
