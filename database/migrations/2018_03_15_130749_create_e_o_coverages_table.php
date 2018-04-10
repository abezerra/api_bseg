<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEOCoveragesTable.
 */
class CreateEOCoveragesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_o_coverages', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('insurer_id')->unsigned();
            $table->foreign('insurer_id')->references('id')->on('e_o_insurances');
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
		Schema::drop('e_o_coverages');
	}
}
