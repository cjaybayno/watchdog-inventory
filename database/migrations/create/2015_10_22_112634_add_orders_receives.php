<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrdersReceives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receives_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number', 50);
            $table->integer('supplier_id');
            $table->integer('branch_id');
            $table->float('total');
            $table->text('remarks');
            $table->dateTime('date_receive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('receives_orders');
    }
}
