<?php

use services\StructureService;
use services\FormBuilderService;

class StructureController extends BaseController 
{
    /*
     * Structure Service
     */
    private  $structureService;
    
    /**
     * Constructor.
     * 
     * @param StructureService $structureService
     */
    public function __construct(StructureService $structureService)
    {
        $this->structureService = $structureService;
    }
     
     /**
      * Save Form Field Attributes.
      * 
      * @param Integer $formId
      * @param Integer $fieldId
      * @param Integer $parentId
      * @return Object
      */
    public function saveFormAttributes($formId, $fieldId, $parentId = 0) 
    {
        return $this->structureService->saveFormAttributes($formId, $fieldId, $parentId);
    }
    
    /**
     * Assign fields to Form
     * 
     * @return Boolean
     */
    public function mapFieldsToForm()
    {
        $formId = Input::get('form_id_map');
        $fields = Input::get('allFields');
        $fields = array_keys($fields);
        $this->structureService->mapFieldsToForm($formId, $fields);
        $formData = $this->structureService->getFormAttributes($formId);
        return View::make('forms.preview',array('formData'=>$formData));
    }
}