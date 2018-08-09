<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
        Schema::create('metas', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('description')->nullable();
            // $table->string('production_meta');
            // $table->string('production_real')->default(0);
            // $table->string('production_percentage')->default(0);
            // $table->string('day');
            
			$table->string('description')->nullable();
			$table->string('month')->nullable();
			$table->string('daily_sales')->nullable();
			$table->integer('employer_id')->unsigned();
            $table->foreign('employer_id')->references('id')->on('users');
            $table->integer('created_by')->unsigned();
			$table->foreign('created_by')->references('id')->on('users');
            $table->integer('insurance_type_id')->unsigned();
			$table->foreign('insurance_type_id')->references('id')->on('insurance_types');
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
