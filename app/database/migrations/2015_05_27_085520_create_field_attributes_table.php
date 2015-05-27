<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('field_attributes', function($table)
		{
			$table->increments('id')->length(10)->unsigned();
                        $table->integer('field_type_id')->length(10)->unsigned();
                        $table->string('name');
                        $table->string('label');
                        $table->string('value');
                        $table->integer('identifier');
		});
                
                Schema::table('field_attributes', function($table) {
                    $table->foreign('field_type_id')->references('id')->unsigned()->on('field_types')->onDelete('cascade');
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('field_attributes');
	}

}
