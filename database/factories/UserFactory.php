<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Student;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'fathers_name' => $faker->name,
        'mothers_name' => $faker->name,
        'gender' => 'Male',
        'institution' => $faker->name,
        'cell' => $faker->ean13,
        'address' => $faker->address,
        'course_name' => $faker->colorName,
        'course_code' => $faker->isbn10,
        'batch_no' => $faker->isbn10,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'created_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
