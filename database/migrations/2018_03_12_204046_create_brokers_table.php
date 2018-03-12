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
            $table->longText('image');
            $table->string('name');
            $table->string('description');
            $table->string('slogan');
            $table->string('ddd');
            $table->string('cellphone');
            $table->string('telephone');
            $table->string('email');
            $table->string('site');
            $table->string('cep');
            $table->string('ibge_code');
            $table->string('address');
            $table->string('neighborhood');
            $table->string('complement');
            $table->string('city');
            $table->string('uf');
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
