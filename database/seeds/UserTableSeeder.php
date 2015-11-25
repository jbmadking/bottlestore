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
                'password' => '$2y$10$qJz15oXLh65sFVHC9KChkeuBaZLauVY/HjD5lSOncSlGZzG5VjcNe',
                'remember_token' => 'j26SrR2lk5Fl5zSFSpjBVpgj2jaRxWEdVBQXrXB7QMUUVA2cMo33K3g40lt8',
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
                'password' => '$2y$10$EFX1sGEGZQTswz4W8eKX8OaNZpofOvIE9I4.AzTCPtQIeCOQj96c2',
                'remember_token' => 'BB1kT3FmXdfpcyvBzKXE62wBjin7hbXOuY9keKVBncyRyfYZp40PPXaJVUkm',
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
                'remember_token' => 'RpJY9Wi0Y7UJCHsJaO5KA6eQavlvhgRlkWab0okLIcJpCnB2ZMqgKInmquFM',
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
