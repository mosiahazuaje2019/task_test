<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invoice;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'date' => $faker->date(),
        'user_id' => $faker->randomDigit,
        'seller_id' => $faker->randomDigit,
        'type' => $faker->jobTitle
    ];


    // ELOQUENT QUERIES
    // QUERY 1 Product::query()->where('invoice_id', '=', 1)->sum('price');
    // QUERY 2 Product::query()->select('invoice_id')->where('quantity', '>', 10)->get();
    // QUERY 3 Product::query()->selectRaw('products.name')->where('price', '>', '1000000')->get();
});
