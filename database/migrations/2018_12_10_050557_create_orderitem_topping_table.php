<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderitemToppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderitem_topping', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('orderitem_id')->unsigned();
            $table->integer('topping_id')->unsigned();

            $table->foreign('orderitem_id')->references('id')->on('orderitems');
            $table->foreign('topping_id')->references('id')->on('toppings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderitem_topping');
    }
}
