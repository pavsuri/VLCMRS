<?php 

namespace services;

use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider 
{
    
    public function register()
    {
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
    }
}
