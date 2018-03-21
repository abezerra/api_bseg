<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLifeCoveragesTable.
 */
class CreateLifeCoveragesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('life_coverages', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('insurer_id')->unsigned();
            $table->foreign('insurer_id')->references('id')->on('individual_life_insurances');
            $table->string('coverage');
            $table->string('value');
            $table->string('franchise');
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
		Schema::drop('life_coverages');
	}
}
