<?php

$factory(
    'App\Repositories\Category', [

        'parent_id' => $faker->numberBetween(1, 20),
        'name' => $faker->lastName,
        'slug' => $faker->slug(4),
        'description' => $faker->sentence('15'),

        'views' => $faker->numberBetween(0, 2000),
        'status' => $faker->numberBetween(0, 1),
    ]
);

$factory(
    'App\Repositories\Product', [

        'name' => $faker->monthName,
        'image' => $faker->imageUrl(),
        'description' => $faker->sentence('15'),

        'price' => $faker->randomFloat(6, 2, 1000),
        'status' => $faker->numberBetween(0, 1),
        'quantity' => $faker->numberBetween(0, 300),
        'views' => $faker->numberBetween(0, 2000),
        'on_special' => $faker->numberBetween(0, 1),
    ]
);

$factory(
    'App\Repositories\CategoryProduct', [
    'category_id' => 'factory:App\Repositories\Category',
    'product_id' => 'factory:App\Repositories\Product',
], 'category_products'
);

$factory(
    'App\Repositories\User',
    [
        'id' => $faker->numberBetween(1, 20),
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => '$2y$10$qJz15oXLh65sFVHC9KChkeuBaZLauVY/HjD5lSOncSlGZzG5VjcNe',
        'remember_token' => '',
        'is_admin' => false,
        'username' => ''
    ]
);

$factory(
    'App\Repositories\Address',
    [
        'id' => $faker->numberBetween(1, 20),
        'street_number' => $faker->numberBetween(23, 345),
        'street_name' => $faker->streetName,
        'suburb' => $faker->name,
        'city' => $faker->city,
        'province' => $faker->name,
        'postal_code' => $faker->numberBetween(1000, 9999)
    ]
);

$factory(
    'App\Repositories\UserAddress', [
    'user_id' => 1,
    'address_id' => 7,
], 'user_addresses'
);
