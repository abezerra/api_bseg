<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSmsTable.
 */
class CreateSmsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sms', function(Blueprint $table) {
            $table->increments('id');
            $table->string('from')->nullable();
            $table->string('sender')->nullable();
            $table->string('to')->nullable();
            $table->longText('message')->nullable();
            $table->string('replyTo')->nullable();
            $table->string('priority')->nullable();
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
		Schema::drop('sms');
	}
}
