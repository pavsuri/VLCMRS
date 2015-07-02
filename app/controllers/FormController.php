<?php

use services\FormListService;
use services\AssignedFormsService;
use Illuminate\Support\Facades\Session;

class FormController extends BaseController 
{
   
    private $formListService;
    
    private $assignedFormsService;
    /**
     * Constructor
     * 
     * @param StructureService $structureService
     * @param FormBuilderService $formBuilderService
     * @param FieldTypesService $fieldTypesService
     * @param AttributeBuilderService $attributeBuilderService
     * @param FormTypesService $formTypesService
     */
    public function __construct(FormListService $formListService, AssignedFormsService $assignedFormsService)
    {        
        $this->formListService = $formListService;
        $this->assignedFormsService = $assignedFormsService;
    }
     
 
    public function categoryTree($userId)
    {       
       $category = $this->formListService->getCategoryForms();       
       $userForms = $this->assignedFormsService->getUserForms($userId);
       $category_array = array();
       $child_array = array();
       $childs = array();      
       foreach($userForms as $cdata)
       {           
           $child_array = explode(',', $cdata->assigned_form_id);
           $category_array[$cdata->form_type_id] = $child_array;
       }       
       $j = 0;
       foreach($category as $data)
       { 
           $checked = "";
                      
           echo '<ul id="category_'.$data->form_type_id.'">'.$data->category_name.'<input type="hidden" name="catagoryId[]" value="'.$data->form_type_id.'"></ul>';                      
           $form_name = explode(',', $data->form_names);
           $form_id = explode(',', $data->form_ids);         
           for($i=0; $i < count($form_id); $i++)
           {                              
               if(isset($category_array[$data->form_type_id]))
               {
                   if(in_array($form_id[$i], $category_array[$data->form_type_id]))                
                        $checked = 'checked';                   
                   else $checked = 'unchecked';                   
               }    
               echo '<li>'.$form_name[$i].'<input '.$checked.' type="checkbox" name="formId_'.$j.'[]" value="'.$form_id[$i].'"></li>';        
           }          
           echo "<br><br><br>";  
           $j++;           
       }
       echo '<input type="hidden" name="userId" value="'.$userId.'" id="userId">';
       echo '<input type="submit" class="btn btn-primary btm-btn" name="submit">';
    }            
            
}