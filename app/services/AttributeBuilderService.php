<?php
namespace services;

use models\AttributeGenerator;
use repositories\AttributeBuilderRepository;

class AttributeBuilderService
{
    /** 
     * Field Attribute Generator Model
     */
    private $attributeGenerator;
    
    /**
     * AttributeBuilderRepository
     */
    private  $attributeBuilderRepository;

    /**
     * Constructor
     * 
     * @param AttributeGenerator $attributeGenerator
     * @param AttributeBuilderRepository $attributeBuilderRepository
     */
    public function __construct(AttributeGenerator $attributeGenerator, 
                                AttributeBuilderRepository $attributeBuilderRepository
                                )
    {
        $this->attributeGenerator = $attributeGenerator;
        $this->attributeBuilderRepository = $attributeBuilderRepository;
    }
    
    /**
     * Create new Attribute Library
     * 
     * @param Integer $fieldType
     * @param String $name
     * @param String $label
     * @param String $value
     * @param Array $optionLabels
     * @param Array $optionValues
     */
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
    
    /**
     * Get Field Attributes  from Library by Field Id
     * 
     * @param Intsger $fieldId
     * @return Object
     */
    public function getAttributesByField($fieldId = 0)
    {
       return $this->attributeBuilderRepository->getAttributesByField($fieldId);
    }
    
    /**
     * Search Fields from Field Library - Field Attributes
     * 
     * @param String $attributeKeyword
     * @param Integer $fieldTypeId
     * @return Array 
     */
    public function searchFieldLibrary($attributeKeyword = '', $fieldTypeId = '')
    {
        return $this->attributeBuilderRepository->searchFieldLibrary($attributeKeyword, $fieldTypeId);
    }
    
    /**
     * Get field data by Field id
     */
    public function getField($fieldId)
    {
        return $this->attributeGenerator->find($fieldId);
    }
}