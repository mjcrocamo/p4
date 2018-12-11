<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderitemFlavorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderitem_flavor', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('orderitem_id')->unsigned();
            $table->integer('flavor_id')->unsigned();

            $table->foreign('orderitem_id')->references('id')->on('orderitems');
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
        Schema::dropIfExists('orderitem_flavor');
    }
}
