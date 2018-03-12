<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateGamificationsTable.
 */
class CreateGamificationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gamifications', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('employer_id')->unsigned();
			$table->foreign('employer_id')->references('id')->on('employers');
			$table->string('points');
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
		Schema::drop('gamifications');
	}
}
