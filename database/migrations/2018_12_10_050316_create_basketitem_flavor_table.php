<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketitemFlavorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basketitem_flavor', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('basketitem_id')->unsigned();
            $table->integer('flavor_id')->unsigned();

            $table->foreign('basketitem_id')->references('id')->on('basketitems');
            $table->foreign('flavor_id')->references('id')->on('flavors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basketitem_flavor');
    }
}