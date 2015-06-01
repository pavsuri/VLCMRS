<?php
use Illuminate\Database\Migrations\Migration;
use Database;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
                $class =  new FieldTypesSeeder();
                
		 $this->class->call('FieldTypesSeeder');
	}

}
