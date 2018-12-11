<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectOrderitemsAndOrders extends Migration
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

            $table->integer('order_id')->unsigned();

            $table->foreign('order_id')->references('id')->on('orders');

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

            $table->dropForeign('orderitems_order_id_foreign');

            $table->dropColumn('order_id');
        });
    }
}
