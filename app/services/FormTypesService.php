<?php
namespace services;

use models\FormTypes;

class FormTypesService
{
    private $formTypes;
    
    /**
     * Constructor
     * 
     * @param FieldTypes $fieldTypes
     */
    public function __construct(FormTypes $formTypes)
    {
        $this->formTypes = $formTypes;
    }
    
    /**
     * Get List of fields.
     * 
     * @return Array
     */
    public function getFormTypes()
    {
        $formTypes = $this->formTypes->get();
        return $formTypes;
    }
}