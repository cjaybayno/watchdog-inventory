<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemsReceives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receives_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->integer('order_id');
            $table->string('quantity');
            $table->float('price');
            $table->float('discount');
            $table->float('sub_total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('receives_items');
    }
}
