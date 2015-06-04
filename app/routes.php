<?php
/**
 * User
 */
Route::group(['namespace' => 'User'], function()
{
  Route::get('/signin', [
    'as' => 'signin',
    'uses' => 'SignInController@index'
  ]);

  Route::post('/signin', [
    'before' => 'csrf',
    'as' => 'signin.perform',
    'uses' => 'SignInController@perform'
  ]);

  Route::get('/adduser', [
    'uses' => 'SignInController@addUser'
  ]);

});


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

//Save Form
Route::any('/updateForm', [
    'as' => 'forms.updateform',
    'uses' => 'FormBuilderController@updateForm'
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


//Search Field Library
Route::post('/searchFieldLibrary', [
    'uses' => 'AttributeBuilderController@searchFieldLibrary'
]);

//Move fields from Library to Form
Route::get('/moveField/{fieldId}', [
    'uses' => 'AttributeBuilderController@moveField'
]);


//Create Form with Fields
/*
 * @TODo: frontend
 */
Route::get('/createForm/{formId}', [
    'as' => 'forms.addFieldsToForm',
    'uses' => 'FormBuilderController@createForm'
]);

//Get Attributes of single field
Route::get('/getFieldAttributes/{fieldId}', [
    'uses' => 'AttributeBuilderController@getAttributesByField'
]);

//Save Form Attributes
Route::get('/saveFormAttributes/{formId}/{fieldId}/{parentId}', [
     'as' => 'forms.addfieldstoform',
    'uses' => 'StructureController@saveFormAttributes'
]);

//Get Form with Attributes
Route::get('/getForm/{formId}', [
    'uses' => 'FormBuilderController@getForm'
]);


//Map fields to Form
Route::post('/mapFormAttributes', [
     'as' => 'forms.mapFieldstoForm',
    'uses' => 'StructureController@mapFieldsToForm'
]);