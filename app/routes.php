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

  Route::get('/signout', [
    'as' => 'signout',
    'uses' => 'SignOutController@index'
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
