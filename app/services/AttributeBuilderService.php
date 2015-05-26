<?php
namespace services;

use models\AttributeGenerator;
use repositories\AttributeBuilderRepository;

class AttributeBuilderService
{
    private $attributeGenerator;
    
    private  $attributeBuilderRepository;


    public function __construct(AttributeGenerator $attributeGenerator, AttributeBuilderRepository $attributeBuilderRepository)
    {
        $this->attributeGenerator = $attributeGenerator;
        $this->attributeBuilderRepository = $attributeBuilderRepository;
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
    
    public function getAttributesByField($fieldId = 0)
    {
       return $this->attributeBuilderRepository->getAttributesByField($fieldId);
    }
}