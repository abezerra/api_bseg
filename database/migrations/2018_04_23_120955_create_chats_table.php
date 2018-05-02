<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateChatsTable.
 */
class CreateChatsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chats', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('clerck_id')->unsigned();
            $table->foreign('clerck_id')->references('id')->on('users');

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('users');
            $table->timestamps();
		});

        Schema::table('conversations', function($table) {
            $table->foreign('chats_id')->references('id')->on('chats')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('chats');
	}
}
