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
}
