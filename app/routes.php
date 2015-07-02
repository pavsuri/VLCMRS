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
    
    //Check Form Exist or Not
     Route::get('/formExistStatus/{formName}/{formId}', [
        'uses' => 'FormBuilderController@formExistStatus'
    ]);
    //Save Form
    Route::any('/updateForm', [
        'as' => 'forms.updateform',
        'uses' => 'FormBuilderController@updateForm'
    ]);

    //Save Form
    Route::any('/deleteForm/{formId}', [
        'uses' => 'FormBuilderController@deleteForm'
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
     
    //Create Fields
    Route::get('/createFields', [
        'as' => 'attributes.createFields',
        'uses' => 'AttributeBuilderController@createFields'
    ]);
    
    //Save New Fields to Library
    Route::post('/saveFieldsToLibrary', [
         'as' => 'attributes.saveFieldsToLibrary',
        'uses' => 'AttributeBuilderController@saveFieldsToLibrary'
    ]);
     
    //Back to Mapping Page
     Route::get('/mapFields', [
        'uses' => 'FormBuilderController@mapFields'
    ]);

     //Update Fields
    Route::post('/updateField', [
         'as' => 'attributes.update',
        'uses' => 'AttributeBuilderController@updateField'
    ]);
     
    //mapFields
    Route::get('/viewForms', [
        'as' => 'viewForms',
        'uses' => 'FormBuilderController@viewForms'
    ]);
    
    //Edit Form Fields
    Route::post('/editFormFields', [
        'as' => 'editFormFields',
        'uses' => 'StructureController@editFormFields'
    ]);
    
    
    Route::get('/', 'SignInController@index');
    
    //users list
    Route::get('/userForms', [        
        'uses' => 'FormBuilderController@userForms'
    ]);
    
    //Asigning forms to perticular user
    Route::get('/categoryTree/{userId}', [        
        'uses' => 'FormController@categoryTree'
    ]);  
    
    //Assigning Forms
    Route::post('/categoryTreeSave', [
        'as' => 'categoryTreeSave',
        'uses' => 'AssignedFormsController@categoryTreeSave'
    ]);
    
});
