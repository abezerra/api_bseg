<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDefaultsTemplatingsTable.
 */
class CreateDefaultsTemplatingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('defaults_templatings', function(Blueprint $table) {
            $table->increments('id');
            $table->longText('description')->nullable();
            $table->string('media_name')->nullable();
            $table->string('media_url')->nullable();
            $table->string('status')->nullable();
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
		Schema::drop('defaults_templatings');
	}
}
