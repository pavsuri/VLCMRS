<?php
namespace services;

use models\FieldTypes;

class FieldTypesService
{
    private $fieldTypes;
    
    /**
     * Constructor
     * 
     * @param FieldTypes $fieldTypes
     */
    public function __construct(FieldTypes $fieldTypes)
    {
        $this->fieldTypes = $fieldTypes;
    }
    
    /**
     * Get Field Type
     */
    public function getById($typeId)
    {
        return $this->fieldTypes->find($typeId);
    }
    
    /**
     * Get List of fields.
     * 
     * @return Array
     */
    public function getAllFields()
    {
        $allFields = $this->fieldTypes->get();
        return $allFields;
    }
}