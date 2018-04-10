<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBrokersTable.
 */
class CreateBrokersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('brokers', function(Blueprint $table) {
            $table->increments('id');
            $table->longText('image')->nulable();
            $table->string('name')->nulable();
            $table->string('description')->nulable();
            $table->string('slogan')->nulable();
            $table->string('ddd')->nulable();
            $table->string('cellphone')->nulable();
            $table->string('telephone')->nulable();
            $table->string('email')->nulable();
            $table->string('site')->nulable();
            $table->string('cep')->nulable();
            $table->string('ibge_code')->nulable();
            $table->string('address')->nulable();
            $table->string('neighborhood')->nulable();
            $table->string('complement')->nulable();
            $table->string('city')->nulable();
            $table->string('uf')->nulable();
            $table->timestamps();
		});

        Schema::table('departaments', function($table) {
            $table->foreign('broker_id')->references('id')->on('brokers');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('brokers');
	}
}
