<?php

namespace repositories;

use models\AssignedForms;
class AssignedFormsRepository extends AbstractBaseRepository
{
    
  protected $model;
  
/**
   * Constructor
   * 
   * @param Form $model
   */
  public function __construct(AssignedForms $model)
  {
    $this->model = $model;
  }
  
  public function getUserForms($userId) 
  {
    return $this->build(
                           $this->model->select ('form_type_id', 'assigned_form_id')
                                    ->where('user_id', $userId)
                                    ->get()
          );
  }  

}
