<?php

use Illuminate\Database\Seeder;
use models\User;
use models\FieldTypes;
use models\FormTypes;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        Eloquent::unguard();
        $this->call('UsersSeeder');
        $this->call('FieldTypesSeeder');
        $this->call('FormTypesSeeder');
    }

}

//Users
class UsersSeeder extends Seeder
{
    public function run() {
        User::create([
            'email' => 'surendra.yallabandi@valuelabs.net',
            'password' => Hash::make('demo'),
            'name' => 'Surendra',
        ]);
        User::create([
            'email' => 'sai.kethamreddy@valuelabs.com',
            'password' => Hash::make('demo'),
            'name' => 'Kishore',
        ]);
    }
}


//FileTypes 
class FieldTypesSeeder extends Seeder 
{
    public function run() {
        FieldTypes::create([
            'name' => 'textbox',
        ]);
        FieldTypes::create([
            'name' => 'textarea',
        ]);
        FieldTypes::create([
            'name' => 'selectbox',
        ]);
        FieldTypes::create([
            'name' => 'radiobutton',
        ]);
        FieldTypes::create([
            'name' => 'checkbox',
        ]);
        FieldTypes::create([
            'name' => 'image',
        ]);
        FieldTypes::create([
            'name' => 'submit',
        ]);
    }
}

//Form Types
class FormTypesSeeder extends Seeder{
    public function run() {
        FormTypes::create([
            'form_type'=>'System Maintenance'
        ]);  
        FormTypes::create([
            'form_type'=>'Machinery'
        ]);  
         FormTypes::create([
            'form_type'=>'Survey'
        ]);  
    }
}

