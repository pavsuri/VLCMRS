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
                        $this->model->join('field_attributes', 'structure.field_id', '=', 'field_attributes.id')
                            ->join('field_types', 'field_attributes.field_type_id', '=', 'field_types.id')
                            ->where('form_id', '=', $formId)
                            ->select('structure.id', 'structure.parent_id', 'structure.field_id',
                                    'field_types.name as fieldType',
                                    'field_attributes.name as fieldName', 
                                    'field_attributes.value as fieldValue', 
                                    'field_attributes.label as fieldLabel',
                                    'field_attributes.identifier as uuid'
                                    )
                            ->orderBy('structure.parent_id', 'asc')
                            ->orderBy('structure.id', 'asc')
                            ->get()
        );
  }
  
  /**
   * Get Form Fields Dat
   */
  public function getFormFields($formId)
  {
      return $this->build(
                        $this->model->join('field_attributes', 'structure.field_id', '=', 'field_attributes.id')
                            ->where('form_id', '=', $formId)
                            ->select('field_attributes.id', 'field_attributes.name')
                            ->orderBy('structure.id', 'asc')
                            ->get()
        );
  }
  
  /**
   * Get Form Structure
   */
  public  function getFormStructure($formId)
  {
      return $this->build(
                        $this->model->join('field_attributes', 'structure.field_id', '=', 'field_attributes.id')
                            ->join('field_types', 'field_attributes.field_type_id', '=', 'field_types.id')
                            ->where('form_id', '=', $formId)
                            ->where('parent_id', '=', 0)
                            ->select('field_attributes.label as fieldLabel',
                                    'field_types.name as fieldType',
                                    'field_attributes.identifier as uuid'
                                    )
                            ->orderBy('structure.parent_id', 'asc')
                            ->orderBy('structure.id', 'asc')
                            ->get()
        );
  }
}
