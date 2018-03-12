<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateClientsTable.
 */
class CreateClientsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
            $table->string('name');
            $table->string('cpf');
            $table->string('rg')->nullable();
            $table->string('ddd_phone')->nullable();
            $table->string('telefone')->nullable();
            $table->string('ddd_cellphone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('neighbhrood')->nullable();
            $table->string('city')->nullable();
            $table->string('uf')->nullable();
            $table->string('birth')->nullable();
            $table->string('from')->nullable();
            $table->string('type')->nullable();
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('clients');
	}
}
