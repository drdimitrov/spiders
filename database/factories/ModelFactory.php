<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    static $password;
//
//    return [
//        'name' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'password' => $password ?: $password = bcrypt('secret'),
//        'remember_token' => str_random(10),
//    ];
//});

$factory->define(App\Complex::class, function (Faker\Generator $faker) {

    return [
        'name' => 'North Holarctic',
    ];
});

$factory->define(App\Complex::class, function (Faker\Generator $faker) {

    return [
        'name' => 'Siberian',
    ];
});

$factory->define(App\Complex::class, function (Faker\Generator $faker) {

    return [
        'name' => 'European',
    ];
});

$factory->define(App\Complex::class, function (Faker\Generator $faker) {

    return [
        'name' => 'Euro-Asian ?',
    ];
});

$factory->define(App\Complex::class, function (Faker\Generator $faker) {

    return [
        'name' => 'Southwestern Asian',
    ];
});

$factory->define(App\Complex::class, function (Faker\Generator $faker) {

    return [
        'name' => 'Mediterranean',
    ];
});

$factory->define(App\Complex::class, function (Faker\Generator $faker) {

    return [
        'name' => 'Endemics',
    ];
});
