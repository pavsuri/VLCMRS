<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFormsTable extends Migration 
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_forms', function(Blueprint $table)
		{
			$table->increments('id')->length(10)->unsigned();
			$table->integer('form_type_id')->length(10)->unsigned();
			$table->integer('form_id')->length(10)->unsigned();
			$table->integer('user_id')->length(10)->unsigned();
			$table->timestamps();
		});
                
                Schema::table('user_forms', function($table) {
                    $table->foreign('form_id')->references('id')->unsigned()->on('forms')->onDelete('cascade');
                    $table->foreign('form_type_id')->references('id')->unsigned()->on('form_types')->onDelete('cascade');
                    $table->foreign('user_id')->references('id')->unsigned()->on('users')->onDelete('cascade');
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_forms');
	}

}
