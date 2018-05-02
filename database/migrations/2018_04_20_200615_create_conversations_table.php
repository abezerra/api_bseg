<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateConversationsTable.
 */
class CreateConversationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conversations', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('chats_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();

            $table->integer('client_id')->unsigned()->nullable();
            $table->foreign('client_id')->references('id')->on('users');

            $table->integer('clerck_id')->unsigned()->nullable();
            $table->foreign('clerck_id')->references('id')->on('users');

            $table->longText('message')->nullable();
            $table->longText('attachment')->nullable();

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
		Schema::drop('conversations');
	}
}
