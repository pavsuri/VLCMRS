<?php
namespace services;

use models\Structure;
use repositories\StructureRepository;
use services\FormBuilderService;
use helpers\HtmlGenerator;

class StructureService
{
    private $structure;
    
    private $structureRepository;
    
    private $formBuilderService;
    
    public function __construct(Structure $strcture, StructureRepository $structureRepository, FormBuilderService $formBuilderService)
    {
        $this->structure = $strcture;
        $this->structureRepository = $structureRepository;
        $this->formBuilderService = $formBuilderService;
    }

    //Save Form Attributes
    public function saveFormAttributes($formId, $fieldId, $parentId = 0)
    {
        $form = $this->structure;
        $form->setFormId($formId);
        $form->setFieldId($fieldId);
        $form->setParentId($parentId);
        $form->save();
    }
    
    //Get form Name by Id
    public function getFormAttributes($formId)
    {
        $formData = $this->formBuilderService->getFormById($formId);
        $fieldsData = $this->structureRepository->getFormAttributes($formId);
        echo HtmlGenerator::htmlForm($formData->name, $formData->type_id);
        $fieldsHierarchicalData = $this->buildTree($fieldsData);
        echo "<pre>"; print_r($fieldsHierarchicalData);
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
     * Generate Html..
     */
    private function hemlGenerator($fieldsHierarchicalData)
    {
        foreach ($fieldsHierarchicalData as $field) {
            echo HtmlGenerator::htmlInput($field->fieldType, $field->fieldName, $field->fieldLabel, $field->fieldValue);echo "<br>";
            if(isset($field->children)) {
                echo  $this->hemlGenerator($field->children);
            }
        }
    }

}