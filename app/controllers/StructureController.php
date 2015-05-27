<?php
use services\StructureService;

class StructureController extends \BaseController 
{
    /*
     * Structure Service
     */
    private  $structureService;
    
    public function __construct(StructureService $structureService)
    {
        $this->structureService = $structureService;
    }
     
     /**
     * Save Form Field Attributes
     */
    public function saveFormAttributes($formId, $fieldId, $parentId = 0) 
    {
        return $this->structureService->saveFormAttributes($formId, $fieldId, $parentId);
    }
}