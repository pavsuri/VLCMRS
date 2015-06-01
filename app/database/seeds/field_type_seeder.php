<?php

use Illuminate\Database\Migrations\Migration;

class FieldTypesSeeder extends Migration 
{

        public function up()
        {
                DB::table('field_types')->insert(
                        array(
                                array('name' => 'textbox'),
                                array('name' => 'textarea'),
                                array('name' => 'selectbox'),   
                                array('name' => 'checkbox'),
                                array('name' => 'container'), 
                                array('name' => 'radio'),
                                array('name' => 'submit'),
                        ));
        }

        public function down()
        {
                DB::table('field_types')->delete();
        }

}
