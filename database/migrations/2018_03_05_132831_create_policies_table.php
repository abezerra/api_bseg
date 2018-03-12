<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePoliciesTable.
 */
class CreatePoliciesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('policies', function(Blueprint $table) {
            $table->increments('id');
			$table->string('insurer');
			$table->string('apoliceNumber');
			$table->string('validity');
			$table->string('classification');
			$table->string('input');
			$table->string('value');
			$table->string('totalOfPortions');
			$table->string('paymentForm');
			$table->string('portion');
			$table->string('date');
			$table->string('portionValue');
			$table->string('cpf');
			$table->string('name');
			$table->string('birth');
			$table->integer('type_id')->insigned();
			$table->integer('coverage_id')->insigned();
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
		Schema::drop('policies');
	}
}
