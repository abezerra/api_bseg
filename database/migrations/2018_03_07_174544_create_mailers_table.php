<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMailersTable.
 */
class CreateMailersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mailers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('from')->nullable();
            $table->string('sender')->nullable();
            $table->string('to')->nullable();
            $table->longText('message')->nullable();
            $table->longText('cc')->nullable();
            $table->longText('bcc')->nullable();
            $table->string('replyTo')->nullable();
            $table->string('subject')->nullable();
            $table->string('priority')->nullable();
            $table->string('attach')->nullable();
            $table->string('attachData')->nullable();
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
		Schema::drop('mailers');
	}
}
