<?php

use Illuminate\Database\Seeder;
use Laracasts\TestDummy\Factory as TestDummy;

class UserAddressTableSeeder extends Seeder
{
    public function run()
    {
        TestDummy::create(
                'App\Repositories\UserAddress',
            [
                'user_id' => 1,
                'address_id' => 1,
            ]
        );
    }
}
