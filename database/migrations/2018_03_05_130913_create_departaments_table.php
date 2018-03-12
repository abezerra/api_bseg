<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDepartamentsTable.
 */
class CreateDepartamentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('departaments', function(Blueprint $table) {
            $table->increments('id');
			$table->string('description');
            $table->string('telephone');
            $table->string('email');
            $table->string('whatsapp');
            $table->integer('broker_id')->unsigned();
            $table->timestamps();
		});

		Schema::table('employers', function($table) {
            $table->foreign('departament_id')->references('id')->on('departaments');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('departaments');
	}
}
