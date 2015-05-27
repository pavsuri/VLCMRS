<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStructureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('structure', function($table)
		{
			$table->increments('id');
                        $table->integer('form_id')->length(10)->unsigned();
                        $table->integer('parent_id')->length(10)->unsigned();
                        $table->integer('field_id')->length(10)->unsigned();

                        
                });
                
                Schema::table('structure', function($table) {
                    $table->foreign('form_id')->references('id')->unsigned()->on('forms')->onDelete('cascade');
                    $table->foreign('field_id')->references('id')->unsigned()->on('field_attributes')->onDelete('cascade');
                });
        }
        /**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('structure');
	}

}
