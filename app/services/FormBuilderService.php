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
        $allForms = $this->formGenerator->where('status', '=', 'active')
                                        ->where('active', '=', 1)
                                        ->get();
        return $allForms;
    }


    /**
     * Create New Form.
     * 
     * @param String $formName
     * @param Integer $typeId
     * @response boolean
     */   
    public function addForm($formName, $typeId, $version, $status, $active, $originatedFrom = 0)
    {
        $input = array('name' => $formName, 'type_id'=>$typeId);
        $form = $this->formGenerator;
        $form->setName($formName);
        $form->setTypeId($typeId);
        $form->setOriginatedFrom($originatedFrom);
        $form->setVersion($version);
        $form->setStatus($status);
        $form->setActive($active);
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
    public function updateForm($formId, $formName, $typeId, $version, $status, $active, $originatedFrom = 0)
    {
        $form = $this->formGenerator;
        $form = $form->find($formId);
        $form->setName($formName);
        $form->setTypeId($typeId);
        $form->setOriginatedFrom($originatedFrom);
        $form->setVersion($version);
        $form->setStatus($status);
        $form->setActive($active);
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
         $formData = $this->formReposiroty->getFormsByType();         
        return $formData;

    }
    
    /**
     * Get all forms by Form Type
     * 
     * @param Integer $formTypeId
     * @return Array
     */
    public function listFormsByTypeId($formTypeId = '')
    {   
        return $formList = $this->formReposiroty->listFormsByTypeId($formTypeId);
    }
        
    /**
     * Check form Already exist or not
     * 
     * @param String $formName
     */
    public function formExist($formName,$formId)
    {
        return $this->formReposiroty->formExist($formName, $formId);
    }
    
    /**
     * Delete form
     */
    public function deleteForm($formId)
    {
        $form = $this->formGenerator;
        $form->find($formId);
        $form->destroy($formId);
        return 'true';
    }
}