<?php
namespace services;

use models\FormList;
use repositories\FormListRepository;

class FormListService
{
    /**
     *Structure Model $structure
     */
    private $formList;
    
    private $formListRepository;
    
    /**
     * Constructor.
     * 
     * @param Structure $strcture
     * @param StructureRepository $structureRepository
     * @param FormBuilderService $formBuilderService
     */
    public function __construct(FormListRepository $formListRepository, FormList $formList)
    {       
        $this->formListRepository = $formListRepository;
        $this->formList = $formList;
    }
    
    /**
     * Get Form data by Form Id
     * 
     * @param Integer $formId
     * @return Object
     */    
    
    public function getCategoryForms()
    {//echo "sdf"; exit;
         $formData = $this->formListRepository->getCategoryForms();                   
         return $formData;
    }           
    
}