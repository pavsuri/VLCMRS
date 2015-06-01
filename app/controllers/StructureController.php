<?php
use services\StructureService;

class StructureController extends \BaseController 
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
}