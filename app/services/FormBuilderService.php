<?php
namespace services;

use models\FormGenerator;
use repositories\FormRepository;

class FormBuilderService
{
    /**
     *Form generator Model 
     */
    private $formGenerator;
    
    /**
     * Form Repository
     */
    private $formReposiroty;
    
    /**
     * Constructor.
     * 
     * @param FormGenerator $formGenerator
     */
    public function __construct(FormGenerator $formGenerator, FormRepository $formReposiroty)
    {
        $this->formGenerator = $formGenerator;
        $this->formReposiroty = $formReposiroty;
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
        $input = array('name' => $formName, 'type_id'=>$typeId);
        $form = $this->formGenerator;
        $form->setName($formName);
        $form->setTypeId($typeId);
        $form->save();
        return $form->id;
    }
    
    /**
     * Update Form 
     * 
     * @param Integer $formId
     * @param String $formName
     * @param Integer $typeId
     * @return null
     */
    public function updateForm($formId, $formName, $typeId)
    {
        $form = $this->formGenerator;
        $form = $form->find($formId);
        $form->setName($formName);
        $form->setTypeId($typeId);
        $form->update();
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
    
    /**
     * Get Form count of all form types
     * 
     * @return Array
     */
    public function getFormsByType()
    {
        return $formData = $this->formReposiroty->getFormsByType();
    }
    
    /**
     * Get all forms by Form Type
     * 
     * @param Integer $formTypeId
     * @return Array
     */
    public function listFormsByTypeId($formTypeId)
    {
        return $formList = $this->formReposiroty->listFormsByTypeId($formTypeId);
    }
}