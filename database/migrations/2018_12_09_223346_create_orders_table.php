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
            $table->integer('order_number');
            $table->string('session_id');
            $table->decimal('order_total');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('ship_address_1');
            $table->string('ship_address_2')->nullable();
            $table->string('ship_city');
            $table->string('ship_state');
            $table->string('ship_country');
            $table->string('ship_zip_code');
            $table->string('bill_address_1');
            $table->string('bill_address_2')->nullable();
            $table->string('bill_city');
            $table->string('bill_state');
            $table->string('bill_country');
            $table->string('bill_zip_code');
            $table->string('email');
            $table->char('card_number',20);
            $table->string('card_exp_date');
            $table->char('cv_code',5);
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
