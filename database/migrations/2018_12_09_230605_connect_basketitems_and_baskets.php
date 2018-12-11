<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectBasketitemsAndBaskets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('basketitems', function (Blueprint $table) {

            $table->integer('basket_id')->unsigned();

            $table->foreign('basket_id')->references('id')->on('baskets');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('basketitems', function (Blueprint $table) {

            $table->dropForeign('basketitems_basket_id_foreign');

            $table->dropColumn('basket_id');
        });
    }
}
