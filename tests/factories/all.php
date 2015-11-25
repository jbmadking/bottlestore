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
        'id' => 1,
        'name' => 'Joshua Matikinye',
        'email' => 'jbmatikinye@gmail.com',
        'password' => '$2y$10$qJz15oXLh65sFVHC9KChkeuBaZLauVY/HjD5lSOncSlGZzG5VjcNe',
        'remember_token' => 'j26SrR2lk5Fl5zSFSpjBVpgj2jaRxWEdVBQXrXB7QMUUVA2cMo33K3g40lt8',
        'is_admin' => false,
        'username' => ''
    ]
);
