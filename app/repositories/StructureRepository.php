<?php

namespace repositories;

use models\Structure;

class StructureRepository extends AbstractBaseRepository
{
    
  protected $model;
  
  /**
   * Constructor
   * 
   * @param Structure $model
   */
  public function __construct(Structure $model)
  {
    $this->model = $model;
  }

  /**
   * Get Form Attributes by Form Id
   * 
   * @param Integer $formId
   * @return type
   */
  public function getFormAttributes($formId)
  {
        return $this->build(
                        $this->model->join('forms', 'structure.form_id', '=', 'forms.id')
                            ->join('field_attributes', 'structure.field_id', '=', 'field_attributes.id')
                            ->join('field_types', 'field_attributes.field_type_id', '=', 'field_types.id')
                            ->where('form_id', '=', $formId)
                            ->select('structure.*', 'field_attributes.name as fieldName', 'field_attributes.value as fieldValue', 'field_attributes.label', 'field_types.name as fieldType')
                            ->get()
        );
  }
}
