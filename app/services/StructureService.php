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
     * Get Form data by Form Id
     * 
     * @param Integer $formId
     * @return Object
     */
    public function getFormAttributes($formId)
    {
        $formData = $this->formBuilderService->getFormById($formId);
        $fieldsData = $this->structureRepository->getFormAttributes($formId);
        $fieldsHierarchicalData = $this->buildTree($fieldsData);
        return $this->hemlGenerator($formData, $fieldsHierarchicalData);
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
     * @param Object $formData 
     * @param Array $fieldsHierarchicalData
     * @return HTML Output
     */
    private function hemlGenerator($formData, $fieldsHierarchicalData)
    { 
        $field = $fieldsHierarchicalData;
        $optionsData =  array();
        $formHtmlDesign = HtmlGenerator::htmlForm($formData->name, $formData->type_id);
        for($i=0; $i<count($field); $i++) {
            if (isset($field[$i]->children)) {
                if (($field[$i]->fieldType == 'selectbox') || ($field[$i]->fieldType == 'checkbox') || ($field[$i]->fieldType == 'radiobutton')) {
                    $optionsData = $field[$i]->children;
                    $formHtmlDesign .= HtmlGenerator::htmlInput($field[$i]->fieldType, $field[$i]->fieldName, $field[$i]->fieldLabel, $field[$i]->fieldValue, $optionsData);
                } else {
                    $formHtmlDesign .= HtmlGenerator::htmlInput($field[$i]->fieldType, $field[$i]->fieldName, $field[$i]->fieldLabel, $field[$i]->fieldValue, $optionsData);
                    $containerData = $field[$i]->children;
                    if (isset($containerData)) { 
                       $this->hemlGenerator($containerData);
                    }
                }
            } else {
                $formHtmlDesign .= HtmlGenerator::htmlInput($field[$i]->fieldType, $field[$i]->fieldName, $field[$i]->fieldLabel, $field[$i]->fieldValue, $optionsData);
            }
            if( (($i+1)%3 == 0)){
                $formHtmlDesign .= '<div class="clearfix visible-lg-block"></div>';
            }
        }
        $formHtmlDesign .= "</form>"; 
        return $formHtmlDesign;
    }

    /**
     * Map Fields to Form
     * 
     * @param Integer $formId 
     * @param Array $fields
     */
    public function mapFieldsToForm($formId, $fields)
    { 
        for($i=0; $i<count($fields);$i++) {
            $attributeData = $this->attributeBuilderRepository->findAttributeDetails($fields[$i]);
            $attribute = $attributeData[0];
            if (($attribute->fieldType == 'selectbox') || ($attribute->fieldType == 'checkbox') || ($attribute->fieldType == 'radiobutton')) {
                $parentId = $attribute->fieldId;
                $currentParentId = 0;
            } else if ($attribute->fieldType == 'option') {
                $currentParentId = $parentId;
            } else {
                $currentParentId = 0;
            }
            $form = new Structure();
            $form->setFormId($formId);
            $form->setFieldId($attribute->fieldId);
            $form->setParentId($currentParentId);
            $form->save();
        }
        
    }
    
    /**
     * Clear all the form fields
     * 
     * @param Integer $formid
     */
    public function clearAllFields($formId)
    {
        return $this->structure->where('form_id', '=', $formId)->delete();
    }
    
    /**
     * Get Form Fields Data.
     * 
     * @param Integer $formId
     */
    public function getFormFields($formId)
    {
        return $this->structureRepository->getFormFields($formId);
    }
}