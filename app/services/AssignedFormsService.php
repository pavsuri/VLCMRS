<?php
namespace services;

use models\AssignedForms;
use repositories\AssignedFormsRepository;
//use services\FormBuilderService;
//use helpers\HtmlGenerator;
//use repositories\AttributeBuilderRepository;

class AssignedFormsService
{
    /**
     *Structure Model $structure
     */
    private $assignedForms;
    
    /**
     * Field AttributeBuilderRepository
     */
    private $assignedFormsRepository;
    
    /**
     * Constructor.
     * 
     * @param Structure $strcture
     * @param StructureRepository $structureRepository
     * @param FormBuilderService $formBuilderService
     */
//    public function __construct(AssignedFormsRepository $assignedFormsRepository, AssignedFormsService $assignedFormsService)
//    {       
//        $this->assignedFormsRepository = $assignedFormsRepository;
//        $this->assignedFormsService = $assignedFormsService;
//    }
    
    public function __construct(AssignedForms $assignedForms, AssignedFormsRepository $assignedFormsRepository)
    {       
        //$this->assignedFormsRepository = $assignedFormsRepository;
        $this->assignedForms = $assignedForms;
        $this->assignedFormsRepository = $assignedFormsRepository;
    }
    
    /**
     * Get Form data by Form Id
     * 
     * @param Integer $formId
     * @return Object
     */    
         
    
    public function saveUserForms($categoryId, $formIds, $userId)
    {        
        $field = new AssignedForms;
        $field->setUserId($userId);
        $field->setAssignedFormId($formIds);   
        $field->setCategoryId($categoryId);       
        $field->save();        
    }
    
    public function deleteUserForms($userId)
    {       
        return $this->assignedForms->where('user_id', '=', $userId)->delete();   
    }
    
    public function getUserForms($userId)
    {
        return $this->assignedFormsRepository->getUserForms($userId); 
    }
    
}