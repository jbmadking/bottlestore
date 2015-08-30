<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street_number');
            $table->string('street_name');
            $table->string('suburb');
            $table->string('city');
            $table->string('province');
            $table->string('post_code');
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }

}
