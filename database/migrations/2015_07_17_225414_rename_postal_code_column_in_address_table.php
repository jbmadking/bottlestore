<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePostalCodeColumnInAddressTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'addresses', function (Blueprint $table) {
            $table->renameColumn('post_code', 'postal_code');
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
        Schema::table(
            'addresses', function (Blueprint $table) {
            $table->renameColumn('postal_code', 'post_code');
        }
        );

    }

}
