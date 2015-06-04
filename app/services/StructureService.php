<?php
namespace services;

use models\Structure;
use repositories\StructureRepository;
use services\FormBuilderService;
use helpers\HtmlGenerator;
use repositories\AttributeBuilderRepository;

class StructureService
{
    /**
     *Structure Model $structure
     */
    private $structure;
    
    /**
     *Structure Repository StructureRepository
     */
    private $structureRepository;
    
    /**
     *Form uilder Service FormBuilderService
     */
    private $formBuilderService;
    
    /**
     * Field AttributeBuilderRepository
     */
    private $attributeBuilderRepository;
    
    /**
     * Constructor.
     * 
     * @param Structure $strcture
     * @param StructureRepository $structureRepository
     * @param FormBuilderService $formBuilderService
     */
    public function __construct(Structure $strcture, StructureRepository $structureRepository, FormBuilderService $formBuilderService, AttributeBuilderRepository $attributeBuilderRepository)
    {
        $this->structure = $strcture;
        $this->structureRepository = $structureRepository;
        $this->formBuilderService = $formBuilderService;
        $this->attributeBuilderRepository = $attributeBuilderRepository;
    }

    /**
     * Save Form with Attributes.
     * 
     * @param Integer $formId
     * @param Integer $fieldId
     * @param Integer $parentId
     * @return Boolean
     */
    public function saveFormAttributes($formId, $fieldId, $parentId = 0)
    {
        $form = $this->structure;
        $form->setFormId($formId);
        $form->setFieldId($fieldId);
        $form->setParentId($parentId);
        $form->save();
        echo "Successfully saved in our database. Your Inserted id is ". $form->id;
    }
    
    /**
     * Get Form data by Form Id
     * 
     * @param Integer $formId
     * @return Object
     */
    public function getFormAttributes($formId)
    {
        $formData = $this->formBuilderService->getFormById($formId);
        $fieldsData = $this->structureRepository->getFormAttributes($formId);
        echo HtmlGenerator::htmlForm($formData->name, $formData->type_id);
        $fieldsHierarchicalData = $this->buildTree($fieldsData);
        $this->hemlGenerator($fieldsHierarchicalData);
        echo "</form>"; 
    }
    
    /**
     * Generate Heirarchical structure.
     * 
     * @param array $elements
     * @param Integer $parentId
     * @return array
     */
    private function buildTree(array $elements, $parentId = 0) 
    {
        $branch = array();  
        foreach ($elements as $element) {
            if ($element->parent_id == $parentId) {
                $children = $this->buildTree($elements, $element->field_id);
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
    
    /**
     * Generate Html.
     * 
     * @param Array $fieldsHierarchicalData
     * @return HTML Output
     */
    private function hemlGenerator($fieldsHierarchicalData)
    { 
        $field = $fieldsHierarchicalData;
        $optionsData =  array();
        for($i=0; $i<count($field); $i++) {
            if (isset($field[$i]->children)) {
                if (($field[$i]->fieldType == 'selectbox') || ($field[$i]->fieldType == 'checkbox') || ($field[$i]->fieldType == 'radio')) {
                    $optionsData = $field[$i]->children;
                    echo HtmlGenerator::htmlInput($field[$i]->fieldType, $field[$i]->fieldName, $field[$i]->fieldLabel, $field[$i]->fieldValue, $optionsData);
                } else {
                    echo HtmlGenerator::htmlInput($field[$i]->fieldType, $field[$i]->fieldName, $field[$i]->fieldLabel, $field[$i]->fieldValue, $optionsData);
                    $containerData = $field[$i]->children;
                    if (isset($containerData)) { 
                       $this->hemlGenerator($containerData);
                    }
                }
            } else {
                echo HtmlGenerator::htmlInput($field[$i]->fieldType, $field[$i]->fieldName, $field[$i]->fieldLabel, $field[$i]->fieldValue, $optionsData);
            }
            echo "<br>";
        }
    }

    /**
     * Map Fields to Form
     * 
     * @param Integer $formId 
     * @param Array $fields
     */
    public function mapFieldsToForm($formId, $fields)
    { 
        echo "<pre>"; print_r($fields);
        
        for($i=0; $i<count($fields);$i++) {
            $attribute = $this->attributeBuilderRepository->findAttributeDetails($fields[$i]);
            //echo "<pre>"; print_r($attribute);exit;
            if (($attribute->fieldType != 'selectbox') || ($attribute->fieldType != 'checkbox') || ($attribute->fieldType != 'radio')) {
                $parentId = $attribute->fieldId;
                $currentParentId = 0;
            } else if ($attribute->fieldType == 'option') {
                $currentParentId = $parentId;
            } else {
                $currentParentId = 0;
            }
            $form = $this->structure;
            $form->setFormId($formId);
            $form->setFieldId($attribute->fieldId);
            $form->setParentId($currentParentId);
            $form->save();
            echo "<pre>"; print_r($form);
        }
        
    }
}