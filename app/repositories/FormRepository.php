<?php

namespace repositories;

use models\FormGenerator;
use \Illuminate\Database\Query\Expression;

class FormRepository extends AbstractBaseRepository
{
    
  protected $model;
  
/**
   * Constructor
   * 
   * @param Form $model
   */
  public function __construct(FormGenerator $model)
  {
    $this->model = $model;
  }

  /**
   * Get Form Attributes by Form Id
   * 
   * @param Integer $formId
   * @return type
   */
  public function getFormsByType()
  {
        $results = $this->build(
                        $this->model->rightjoin('form_types', 'forms.type_id', '=', 'form_types.id')
                            ->orderBy('forms.name', 'asc')
                            ->select ('form_types.*', new \Illuminate\Database\Query\Expression('count(forms.id) as total'))
                            ->groupBy('forms.type_id')
                            ->get()
        );
        return $results;
  }
  
  /**
    * Get all forms by Form Type
    * 
    * @param Integer $formTypeId
    * @return Array
    */
  public function listFormsByTypeId($formTypeId)
  {
      $results = $this->build(
                        $this->model->join('form_types', 'forms.type_id', '=', 'form_types.id')
                            ->orderBy('forms.name', 'asc')
                            ->select ('forms.*', 'form_types.form_type')
                            ->where('forms.type_id', '=', $formTypeId)
                            ->get()
        );
        return $results;
  }
  
  /**
    * Check form Already exist or not
    * 
    * @param String $formName
    */
    public function formExist($formName) 
    {
        $results = $this->build(
                $this->model->where('forms.name', '=', $formName)
                        ->first()
        );
        return $results;
   }

}
