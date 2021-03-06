<?php
namespace services;

use models\FormGenerator;

class FormBuilderService
{
    /**
     *Form generator Model 
     */
    private $formGenerator;
    
    /**
     * Constructor.
     * 
     * @param FormGenerator $formGenerator
     */
    public function __construct(FormGenerator $formGenerator)
    {
        $this->formGenerator = $formGenerator;
    }
    
    /**
     * Get Form Lisiting.
     * 
     * @return Array
     */
    public function getAllForms()
    {
        $allForms = $this->formGenerator->get();
        return $allForms;
    }


    /**
     * Create New Form.
     * 
     * @param String $formName
     * @param Integer $typeId
     * @response boolean
     */   
    public function addForm($formName, $typeId)
    {
        $form = $this->formGenerator;
        $form->setName($formName);
        $form->setTypeId($typeId);
        $form->save();
    }
    
    /**
     * Get Form data without attributes.
     * 
     * @param Integer $formId
     * @return type
     */
    public function getFormById($formId)
    {
        $formData = $this->formGenerator->find($formId);
        return $formData;
    }
}