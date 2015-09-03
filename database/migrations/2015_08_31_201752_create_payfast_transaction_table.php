<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayFastTransactionTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('m_payment_id', 50);
            $table->string('pf_payment_id', 50);
            $table->string('payment_status', 50);
            $table->string('item_name');
            $table->text('item_description');
            $table->decimal('amount_gross', 18, 2);
            $table->decimal('amount_fee', 18, 2);
            $table->decimal('amount_net', 18, 2);
            $table->string('name_first');
            $table->string('name_last');
            $table->string('email_address', 50);
            $table->string('merchant_id', 50);
            $table->string('signature');
            $table->string('custom_str1');
            $table->string('custom_str2');
            $table->string('custom_str3');
            $table->string('custom_str4');
            $table->string('custom_str5');
            $table->string('custom_int1');
            $table->string('custom_int2');
            $table->string('custom_int3');
            $table->string('custom_int4');
            $table->string('custom_int5');
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
        Schema::drop('transactions');
    }

}
