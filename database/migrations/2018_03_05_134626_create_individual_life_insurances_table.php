<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateIndividualLifeInsurancesTable.
 */
class CreateIndividualLifeInsurancesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('individual_life_insurances', function(Blueprint $table) {
            $table->increments('id');
            $table->string('insurer')->nullable();
            $table->string('apoliceNumber')->nullable();
            $table->string('validity')->nullable();
            $table->string('accession')->nullable();
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
		Schema::drop('individual_life_insurances');
	}
}
