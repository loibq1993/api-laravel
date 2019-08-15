<?php

use App\Models\Supplier;
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

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'company_name' => $faker->name,
        'short_name' => null,
        'address' => Str::random(20),
        'phone' => $faker->phoneNumber,
        'fax' => null,
        'website' => Str::random(10).'.com',
        'status' => array_rand(array(0,1))
    ];
});
