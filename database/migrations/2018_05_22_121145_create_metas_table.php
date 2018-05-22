<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMetasTable.
 */
class CreateMetasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('metas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->string('production_meta');
            $table->string('production_real')->default(0);
            $table->string('rate_profit_meta');
            $table->string('rate_profit_real')->default(0);
            $table->string('app_downloads_number_meta');
            $table->string('app_downloads_number_real')->default(0);
            $table->string('news_contracts_meta');
            $table->string('news_contracts_real')->default(0);
            $table->string('percentage_of_renovations_meta');
            $table->string('percentage_of_renovations_real')->default(0);
            $table->string('percentage_of_insurances_versus_news_meta');
            $table->string('percentage_of_insurances_versus_news_real')->default(0);
            $table->integer('employer_id')->unsigned();
            $table->foreign('employer_id')->references('id')->on('users');
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
		Schema::drop('metas');
	}
}
