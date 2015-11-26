<?php

use Illuminate\Database\Seeder;
use Laracasts\TestDummy\Factory as TestDummy;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        TestDummy::create(
                'App\Repositories\User',
            [
                'id' => 1,
                'name' => 'Joshua Matikinye',
                'email' => 'jbmatikinye@gmail.com',
                'password' => '$2y$10$oT76/dGj5PcPm1LxphH9Teq.l8KuO1Y2gdCif9LRuy4tDVuy5lqYW',
                'remember_token' => '',
                'is_admin' => false,
                'username' => ''
            ]
        );

        TestDummy::create(
            'App\Repositories\User',
            [
                'id' => 4,
                'name' => 'Bradshaw Matikinye',
                'email' => 'joshua@matikinye.com',
                'password' => '$2y$10$6SK938GEbgA4B1lomNCJJOBhg2rLAxrITMZlXFodhX21Howr4xoDK',
                'remember_token' => '',
                'is_admin' => true,
                'username' => ''
            ]
        );

        TestDummy::create(
            'App\Repositories\User',
            [
                'id' => 11,
                'name' => 'Bronson Dunbar',
                'email' => 'bronson@gmail.com',
                'password' => '$2y$10$ZCP9iIEo3MwZFGWQ3d0aIOZOn7fjw1yPsZy9aY03SuHdrcRReACli',
                'remember_token' => 'pWuh6tqXDAQvJZvO4wW7qNOeRNHsvqI0rjC3gFGUWhtFIgLtaGlwHgXwRYYX',
                'is_admin' => false,
                'username' => ''
            ]
        );

        TestDummy::create(
            'App\Repositories\User',
            [
                'id' => 49,
                'name' => 'Lindsay Matikinye',
                'email' => 'lindsay@matikinye.co.za',
                'password' => '$2y$10$pUc7SB3.ccDr/wenG6nRSee6oO11r7eHyQG0M8g2THbPUeuD6G90O',
                'remember_token' => '',
                'is_admin' => false,
                'username' => ''
            ]
        );

        TestDummy::create(
            'App\Repositories\User',
            [
                'id' => 75,
                'name' => 'Slick Rick',
                'email' => 'slickrick@gmail.com',
                'password' => '$2y$10$beYAz8WKGH2leJeqwa64geKl16kkpMbP2ZNmKbf0rSaeTC80So03W',
                'remember_token' => null,
                'is_admin' => false,
                'username' => ''
            ]
        );
    }
}
