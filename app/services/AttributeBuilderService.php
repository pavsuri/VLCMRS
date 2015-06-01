<?php
namespace services;

use models\AttributeGenerator;
use repositories\AttributeBuilderRepository;
use models\FieldGroups;

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
     *Field Groups Model
     * 
     */
    private $fieldGroups;


    /**
     * Constructor
     * 
     * @param AttributeGenerator $attributeGenerator
     * @param AttributeBuilderRepository $attributeBuilderRepository
     * @param FieldGroups $fieldGroups
     */
    public function __construct(AttributeGenerator $attributeGenerator, 
                                AttributeBuilderRepository $attributeBuilderRepository,
                                FieldGroups $fieldGroups)
    {
        $this->attributeGenerator = $attributeGenerator;
        $this->attributeBuilderRepository = $attributeBuilderRepository;
        $this->fieldGroups = $fieldGroups;
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
    public function saveAttributes($fieldType, $name, $label, $value, $optionLabels = array(), $optionValues= array())
    {
        $field = $this->attributeGenerator;
        $field->setName($name);
        $field->setFieldTypeId($fieldType);
        $field->setLabel($label);
        $field->setValue($value);
        $field->identifier = rand();
        $field->save();
        $insertedId = $field->id;
        if (count($optionLabels) > 0) {
            for($i = 0; $i<count($optionLabels) ; $i++) {
                $this->fieldGroups->setFieldId($insertedId);
                $this->fieldGroups->setName($optionLabels[$i]);
                $this->fieldGroups->setValue($optionValues[$i]);
                $this->fieldGroups->save();
                //Clear object
                foreach ($this->fieldGroups as $key => $value) {
                    $this->fieldGroups->$key = null; 
                    $this->fieldGroups->id= null;
                }
            }
        }
        
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
}