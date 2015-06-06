<?php
/**
 * User
 */
Route::group(['namespace' => 'User'], function()
{
  Route::get('/', [
    'uses' => 'SignInController@index'
  ]);
  
  Route::get('/login', [
    'as' => 'login',
    'uses' => 'SignInController@index'
  ]);
  
  Route::post('/signin', [
    'as' => 'signin.perform',
    'uses' => 'SignInController@perform'
  ]);

  Route::post('/adduser', [
    'uses' => 'SignInController@addUser'
  ]);

  Route::get('/signout', [
    'uses' => 'SignInController@signout'
  ]);
});


//Add Auth check and redirect to ligin if not loggedin
Route::group(array('before' => 'auth'), function(){
//All the routes in this Group..

    //DashBoard
    Route::get('/dashboard', [
        'as' => 'dashboard',
        'uses' => 'FormBuilderController@dashboard'
    ]);
    
    //User Forms
    Route::get('/formList/{formTypeId}', [
        'uses' => 'FormBuilderController@formList'
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
    
    //Get Form with Attributes
    Route::get('/getForm/{formId}', [
        'uses' => 'FormBuilderController@getForm'
    ]);
    
    //Save Form
    Route::any('/updateForm', [
        'as' => 'forms.updateform',
        'uses' => 'FormBuilderController@updateForm'
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

    //Get Attributes of single field
    Route::get('/getFieldAttributes/{fieldId}', [
        'uses' => 'AttributeBuilderController@getAttributesByField'
    ]);

    //Form Preview
    Route::get('/preview/{formId}', [
        'as' => 'forms.preview',
        'uses' => 'FormBuilderController@preview'
    ]);
    
    //Map fields to Form
    Route::post('/mapFormAttributes', [
         'as' => 'forms.mapFieldstoForm',
        'uses' => 'StructureController@mapFieldsToForm'
    ]);
    
    //Get Form Details
     Route::get('/getFormDetails/{formId}', [
        'uses' => 'FormBuilderController@getFormDetails'
    ]);

    Route::get('/', 'SignInController@index');
});
