<?php

$factory(
    'App\Repositories\Category', [

        'parent_id' => $faker->numberBetween(1, 20),
        'name' => $faker->lastName,
        'slug' => $faker->slug(4),
        'description' => $faker->sentence('15'),

        'views' => $faker->numberBetween(0, 2000),
        'status' => $faker->numberBetween(0, 1),
//        'created_at' => $faker->dateTimeBetween('-1 years', '+1 years'),
//        'updated_at' => $faker->dateTimeBetween('-1 years', '+1 years')
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

//        'created_at' => $faker->dateTimeBetween('-1 years', '+1 years'),
//        'updated_at' => $faker->dateTimeBetween('- 1 years', '+1 years')
    ]
);

$factory(
    'App\Repositories\CategoryProduct', [
        'category_id' => 'factory:App\Repositories\Category',
        'product_id' => 'factory:App\Repositories\Product',
    ],  'category_products'
);
