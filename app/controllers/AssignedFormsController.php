<?php

use services\AssignedFormsService;
use Illuminate\Support\Facades\Redirect;

class AssignedFormsController extends BaseController 
{

    /**
     * AttributeBuilderService
     */
    private $assignedFormsService;
    
    /**
     * Constructor.
     * 
     * @param AttributeBuilderService $attributeBuilderService
     * @param FieldTypesService $fieldTypesService
     */
    
    
    
    public function __construct(AssignedFormsService $assignedFormsService)
    {
        $this->assignedFormsService = $assignedFormsService;        
    }
    

    public function categoryTreeSave()
    {               
        $this->assignedFormsService->deleteUserForms($_POST['userId']);
        for($i=0; $i < count($_POST['catagoryId']); $i++)
        {
           if(isset($_POST['formId_'.$i])) {
                $formIds = implode(',', $_POST['formId_'.$i]);
                $categoryId = $_POST["catagoryId"][$i];                           
                $this->assignedFormsService->saveUserForms($categoryId, $formIds, $_POST['userId']);           
           }      
        }                
        return Redirect::to('userForms');
    } 
}
