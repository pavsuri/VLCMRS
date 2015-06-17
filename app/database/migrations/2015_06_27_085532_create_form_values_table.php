<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_values', function(Blueprint $table)
		{
			$table->increments('id')->length(10)->unsigned();
                        $table->integer('user_form_id')->length(10)->unsigned();
                        $table->integer('uuid');
                        $table->string('value');                        
		});
                
                Schema::table('form_values', function($table) {
                    $table->foreign('user_form_id')->references('id')->on('user_forms')->onDelete('cascade');
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('form_values');
	}

}
