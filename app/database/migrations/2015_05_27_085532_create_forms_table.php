<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forms', function(Blueprint $table)
		{
			$table->increments('id')->length(10)->unsigned();
                        $table->string('name');
                        $table->integer('type_id');
                        $table->integer('originated_from')->nullable();
                        $table->integer('version');
                        $table->enum('status', ['active', 'versioned', 'deleted']);
                        $table->integer('active');
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
		Schema::drop('forms');
	}

}
