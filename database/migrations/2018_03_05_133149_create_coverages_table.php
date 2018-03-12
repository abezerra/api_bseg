<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCoveragesTable.
 */
class CreateCoveragesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coverages', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('insurer_id')->unsigned();
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
		Schema::drop('coverages');
	}
}
