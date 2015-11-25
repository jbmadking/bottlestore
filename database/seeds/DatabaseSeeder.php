<?php

use Codeception\Lib\Interfaces\Db;
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

//        DB::table('addresses')->delete();
//        DB::table('user_addresses')->delete();
        //DB::table('users')->delete();
        DB::table('products')->delete();
        DB::table('categories')->delete();


        $this->call('CategoryProductTableSeeder');
        $this->call('UsersTableSeeder');
    }

}
