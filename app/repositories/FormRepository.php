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
                        $this->model->join('form_types', 'forms.type_id', '=', 'form_types.id')
                            ->orderBy('forms.name', 'asc')
                            ->select ('form_types.*', new \Illuminate\Database\Query\Expression('count(*) as total'))
                            ->groupBy('forms.type_id')
                            ->get()
        );
        return $results;
  }
}
