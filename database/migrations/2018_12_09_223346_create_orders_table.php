<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('session_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('state');
            $table->string('country');
            $table->integer('zip_code');
            $table->integer('card_number');
            $table->string('card_exp_date');
            $table->integer('cv_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
