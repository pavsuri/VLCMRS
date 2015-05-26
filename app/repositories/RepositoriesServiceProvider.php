<?php namespace repositories;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider {

  public function register()
  {

    // AttributeBuilder Repository
    $this->app->bind(
      'repositories\AttributeBuilderRepository'
    );
    
    // Structure Repository
    $this->app->bind(
      'repositories\StructureRepository'
    );

  }

}
