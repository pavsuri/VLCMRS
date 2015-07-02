<?php 

namespace services;

use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider 
{
    
    public function register()
    {
      /**
       * SignIn User
       */
      $this->app->bind(
        'services\UserService'
      );

      $this->app->bind(
        'services\FormBuilderService'
      );
      
      $this->app->bind(
        'services\FieldTypesService'
      );
      
      $this->app->bind(
        'services\AttributeBuilderService'
      );
      
      $this->app->bind(
        'services\StructureService'
      );
      
      $this->app->bind(
        'services\User\UserFormsService'
      );
      
      $this->app->bind(
        'services\User\FormValuesService'
      );
      
      $this->app->bind(
        'services\FormListService'
      );
      
      $this->app->bind(
        'services\AssignedFormsService'
      );
      
      
    }
}
