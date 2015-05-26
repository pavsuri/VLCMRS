<?php
namespace services;

use models\FormGenerator;

class FormBuilderService
{
    private $formGenerator;
    
    public function __construct(FormGenerator $formGenerator)
    {
        $this->formGenerator = $formGenerator;
    }
    
    public function getAllForms()
    {
        $allForms = $this->formGenerator->get();
        return $allForms;
    }


    //Save Form Name
    public function addForm($formName, $typeId)
    {
        $form = $this->formGenerator;
        $form->setName($formName);
        $form->setTypeId($typeId);
        $form->save();
    }
    
    //Get form Name by Id
    public function getFormById($formId)
    {
        $formData = $this->formGenerator->find($formId);
        return $formData;
    }
}