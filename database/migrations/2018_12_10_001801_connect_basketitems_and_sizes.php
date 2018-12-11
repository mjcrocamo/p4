<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectBasketitemsAndSizes extends Migration
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

            $table->integer('size_id')->unsigned();

            $table->foreign('size_id')->references('id')->on('sizes');

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

            $table->dropForeign('basketitems_size_id_foreign');

            $table->dropColumn('size_id');
        });
    }
}
