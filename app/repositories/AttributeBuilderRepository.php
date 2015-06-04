<?php

namespace repositories;

use models\AttributeGenerator;

class AttributeBuilderRepository extends AbstractBaseRepository
{
    
  /**
   * Eloquent model
   *
   * @var mixed
   */
  protected $model;

  /*
   * Constructor.
   *  
   * Field Attribute Model $model
   */
  public function __construct(AttributeGenerator $model)
  {
    $this->model = $model;
  }

  /**
   * Get Attributes by Field Type
   * 
   * @param Integer $fieldId
   * @return Array
   */
  public function getAttributesByField($fieldId)
  {
      if ($fieldId == 'all') {
            return $this->build(
                            $this->model->where('field_type_id', 'like', '%')->get()
            );
        } else {
            return $this->build(
                            $this->model->where('field_type_id', '=', $fieldId)->get()
            );
        }
    
  }
  
  /**
   * Search Fields by Keyword or Field type
   * 
   * @param type $attributeKeyword
   * @param type $fieldTypeId
   * @return Array
   */
  public function searchFieldLibrary($attributeKeyword, $fieldTypeId)
  {
      if (($attributeKeyword != '') && ($fieldTypeId != '')) {
            $results = $this->build(
                            $this->model->where('field_type_id', '=', $fieldTypeId)
                                    ->Where('name', 'like', $attributeKeyword . '%')->get()
            );
        } else if (($attributeKeyword == '') && ($fieldTypeId != '')) {
            $results =  $this->build(
                            $this->model->where('field_type_id', '=', $fieldTypeId)->get()
            );
        } else if (($attributeKeyword != '') && ($fieldTypeId == '')) {
            $results =  $this->build(
                            $this->model->where('name', 'like', $attributeKeyword . '%')->get()
            );
        } else {
            $results =  $this->build(
                            $this->model->orderBy('name', 'asc')->get()
            );
        }
        return $results;
  }
  
  public function findAttributeDetails($fieldId)
  {
      return $this->build(
                        $this->model->join('field_types', 'field_attributes.field_type_id', '=', 'field_types.id')
                            ->where('field_attributes.id', '=', $fieldId)
                            ->select('field_types.name as fieldType',
                                    'field_attributes.name as fieldName', 
                                    'field_attributes.value as fieldValue', 
                                    'field_attributes.label as fieldLabel'
                                    )
                            ->first()
        );
  }
}