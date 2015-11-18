<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 50);
			$table->string('contact_person', 50);
			$table->string('contact_number');
			$table->string('fax_number');
			$table->string('email');			
			$table->string('street');
			$table->string('brgy_town');
			$table->string('province_city');
			$table->string('zipcode');
			$table->string('country');
			$table->string('address_type');
			$table->string('payment_terms');
			$table->string('taxing_scheme');
			$table->text('remarks');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('suppliers');
    }
}
