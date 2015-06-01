<?php

namespace repositories;

use models\Structure;

use models\FieldGroups;

class StructureRepository extends AbstractBaseRepository
{
    
  protected $model;
  
  protected $fieldGroups;
  
  /**
   * Constructor
   * 
   * @param Structure $model
   */
  public function __construct(Structure $model, FieldGroups $fieldGroups)
  {
    $this->model = $model;
    $this->fieldGroups = $fieldGroups;
          
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
                                    'field_attributes.label as fieldLabel'
                                    )
                            ->orderBy('structure.parent_id', 'asc')
                            ->orderBy('structure.id', 'asc')
                            ->get()
        );
  }
  
  /**
   * Get Select/Checkbox/Radio option values
   */
  public function getGroupOptions($fieldId){
       return $this->build(
                        $this->fieldGroups->where('field_id', '=', $fieldId)
                            ->orderBy('name', 'asc')
                            ->get()
        );
  }
}
