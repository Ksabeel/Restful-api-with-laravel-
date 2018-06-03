<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'verified' => $verified = $faker->boolean,
        'verification_token' => $verified == true ? null : str_random(40),
        'admin' => $faker->boolean,
    ];
});

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
    ];
});

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(3),
        'quantity' => $faker->numberBetween(1, 10),
        'status' => $faker->boolean,
        'image' => $faker->randomElement(['1.jpg', '2.jpg', '3.png']),
        'seller_id' => App\User::inRandomOrder()->first()->id,
    ];
});

$factory->define(App\Transaction::class, function (Faker $faker) {

	$seller = App\Seller::has('product')->get()->random();
	$buyer = App\User::all()->except($seller->id)->random();

    return [
        'quantity' => $faker->numberBetween(1, 3),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()->id,
    ];
});
