<?php
use Illuminate\Database\Seeder;

use Laracasts\TestDummy\Factory as TestDummy;

class AddressTableSeeder extends Seeder
{
    public function run()
    {

        TestDummy::create(
            'App\Repositories\Address',
            [
                'id' => 1,
                'street_number' => '36',
                'street_name' => 'McGhie Avenue',
                'suburb' => 'Rhodene',
                'city' => 'Masvingo',
                'province' => 'Masvingo',
                'postal_code' => 2343,
            ]
        );
    }
}


