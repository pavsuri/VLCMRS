<?php
namespace services;

use models\FieldTypes;

class FieldTypesService
{
    private $fieldTypes;
    
    public function __construct(FieldTypes $fieldTypes)
    {
        $this->fieldTypes = $fieldTypes;
    }
    
    public function getAllFields()
    {
        $allFields = $this->fieldTypes->get();
        return $allFields;
    }
}