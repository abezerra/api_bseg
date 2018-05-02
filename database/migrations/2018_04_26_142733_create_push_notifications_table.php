<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePushNotificationsTable.
 */
class CreatePushNotificationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('push_notifications', function(Blueprint $table) {
            $table->increments('id');
            $table->string('heading')->nullable();
            $table->string('subtitle')->nullable();
            $table->longText('message')->nullable();
            $table->integer('sended_by')->unsigned();
            $table->foreign('sended_by')->references('id')->on('users');
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
		Schema::drop('push_notifications');
	}
}
