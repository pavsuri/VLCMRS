<?php

namespace repositories;

use models\AttributeGenerator;

class AttributeBuilderRepository extends AbstractBaseRepository
{
    
  protected $model;

  public function __construct(AttributeGenerator $model)
  {
    $this->model = $model;
  }

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
