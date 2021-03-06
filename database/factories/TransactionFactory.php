<?php

use Faker\Generator as Faker;
use App\Seller;
use App\User;

$factory->define(App\Transaction::class, function (Faker $faker) {
    $seller = Seller::has('products')->get()->random();
    $buyer = User::all()->except($seller->id)->random();
    
    return [
        'quantity' => $faker->numberBetween(1, 10),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()->id,
    ];
});
