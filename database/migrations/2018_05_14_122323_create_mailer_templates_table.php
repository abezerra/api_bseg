<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMailerTemplatesTable.
 */
class CreateMailerTemplatesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mailer_templates', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('file_name');
            $table->string('file_path');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
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
		Schema::drop('mailer_templates');
	}
}
