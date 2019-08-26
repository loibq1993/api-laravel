<?php

use App\Models\Product;
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

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'feature_image' => str_slug($faker->name, '-').'.png',
        'description' => $faker->sentence,
        'slug' => str_slug($faker->name, '-'),
        'status' => array_rand(array(0,1)),
        'price' => array_rand(array(0,100000)),
        'SKU' => Str::random(),
        'supplier_id' => 0
    ];
});
