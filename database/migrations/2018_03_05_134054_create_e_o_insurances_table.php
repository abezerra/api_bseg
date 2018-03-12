<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEOInsurancesTable.
 */
class CreateEOInsurancesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_o_insurances', function(Blueprint $table) {
            $table->increments('id');
            $table->string('insurer')->nullable();
            $table->string('apoliceNumber')->nullable();
            $table->string('validity')->nullable();
            $table->string('classification')->nullable();
            $table->string('input')->nullable();
            $table->string('value')->nullable();
            $table->string('totalOfPortions')->nullable();
            $table->string('paymentForm')->nullable();
            $table->string('portion')->nullable();
            $table->string('date')->nullable();
            $table->string('portionValue')->nullable();
			$table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('taker')->nullable();
            $table->string('cnpj')->nullable();
            $table->integer('coverage_id')->unsigned()->nullable();
            $table->longText('file')->nullable();
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
		Schema::drop('e_o_insurances');
	}
}
