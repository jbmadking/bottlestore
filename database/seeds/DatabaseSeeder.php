<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call('CategoryProductTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('AddressTableSeeder');
        $this->call('UserAddressTableSeeder');
    }

}
