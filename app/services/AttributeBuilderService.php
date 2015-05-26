<?php
namespace services;

use models\AttributeGenerator;

class AttributeBuilderService
{
    private $attributeGenerator;
    
    public function __construct(AttributeGenerator $attributeGenerator)
    {
        $this->attributeGenerator = $attributeGenerator;
    }
    
    public function saveAttributes($fieldType, $name, $label, $value)
    {
        $field = $this->attributeGenerator;
        $field->setName($name);
        $field->setFieldTypeId($fieldType);
        $field->setLabel($label);
        $field->setValue($value);
        $field->identifier = rand();
        $field->save();
    }
}