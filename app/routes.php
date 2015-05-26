<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Display all Forms
Route::get('/', [
    'uses' => 'FormBuilderController@index'
]);

//Add New Form
Route::get('/addForm', [
    'as' => 'forms.index',
    'uses' => 'FormBuilderController@addForm'
]);

//Save Form
Route::any('/saveForm', [
    'as' => 'forms.saveform',
    'uses' => 'FormBuilderController@saveForm'
]);


//Set Attributes to Fields
Route::get('/setAttributes', [
    'uses' => 'AttributeBuilderController@index'
]);

//Save Attributes
Route::post('/saveAttributes', [
    'as' => 'attributes.save',
    'uses' => 'AttributeBuilderController@saveAttributes'
]);



//Create Form with Fields
Route::get('/createForm/{formId}', [
    'as' => 'forms.addFieldsToForm',
    'uses' => 'FormBuilderController@createForm'
]);



