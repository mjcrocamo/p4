<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectOrderitemsAndSizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('orderitems', function (Blueprint $table) {

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
        Schema::table('orderitems', function (Blueprint $table) {

            $table->dropForeign('orderitems_size_id_foreign');

            $table->dropColumn('size_id');
        });
    }
}
