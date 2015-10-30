<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Laracasts\TestDummy\Factory as TestDummy;

class CategoryProductTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->delete();
        DB::table('categories')->delete();

        TestDummy::times(20)->create('App\Repositories\CategoryProduct');
    }
}
