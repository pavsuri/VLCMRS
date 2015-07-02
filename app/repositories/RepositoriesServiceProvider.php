<?php namespace repositories;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider {

  public function register()
  {

    // Form Repository
    $this->app->bind(
      'repositories\FormRepository'
    );
    // AttributeBuilder Repository
    $this->app->bind(
      'repositories\AttributeBuilderRepository'
    );
    
    // Structure Repository
    $this->app->bind(
      'repositories\StructureRepository'
    );
    
    // FieldGroups Repository
    $this->app->bind(
      'repositories\FieldGroupsRepository'
    );
    
    // UserForms Repository
    $this->app->bind(
      'repositories\User\UserFormRepository'
    );
    
    // FormValues Repository
    $this->app->bind(
      'repositories\User\FormValuesRepository'
    );
    
    // FormValues Repository
    $this->app->bind(
      'repositories\AssignedFormsRepository'
    );
  }

}
