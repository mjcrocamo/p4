<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketitemToppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basketitem_topping', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('basketitem_id')->unsigned();
            $table->integer('topping_id')->unsigned();

            $table->foreign('basketitem_id')->references('id')->on('basketitems');
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
        Schema::dropIfExists('basketitem_topping');
    }
}
