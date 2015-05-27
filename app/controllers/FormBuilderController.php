<?php

use services\FormBuilderService;
use services\FieldTypesService;
use services\AttributeBuilderService;
use services\StructureService;

class FormBuilderController extends \BaseController 
{
    private $formBuilderService;
    private $fieldTypesService;
    private $attributeBuilderService;
    private $structureService;
    

    public function __construct(FormBuilderService $formBuilderService, 
                                FieldTypesService $fieldTypesService, 
                                AttributeBuilderService $attributeBuilderService, 
                                StructureService $structureService
                                ) 
    {
        $this->formBuilderService = $formBuilderService;
        $this->fieldTypesService = $fieldTypesService;
        $this->attributeBuilderService = $attributeBuilderService;
        $this->structureService = $structureService;
    }

    /**
     * Default Landing page. It shows list of Forms
     *
     * @return Response
     */
    public function index() 
    {
        $data = $this->formBuilderService->getAllForms();
        return View::make('forms.allForms', array('forms' => $data));
    }

    /**
     * Add new form
     *
     * @return Response
     */
    public function addForm() 
    {
        return View::make('forms.index');
    }

    /**
     * Create form name page.
     *
     * @return Response
     */
    public function createForm($formId) 
    {
        $formData = $this->formBuilderService->getFormById($formId);
        $fieldsData = $this->fieldTypesService->getAllFields();
        return View::make('forms.addFieldsToForm', array('formData' => $formData, 'fields' => $fieldsData));
    }

    /**
     * Save new form to form table.
     *
     * @return Response
     */
    public function saveForm() 
    {
        $name = Input::get('name');
        $typeId = Input::get('type_id');
        $this->formBuilderService->addForm($name, $typeId);
        $message = "Successfully saved in our database";
        return json_encode($message);
        //$data = $this->formBuilderService->getAllForms();
        //return View::make('forms.allForms', array('forms' => $data, 'message' => $message));
    }

    /**
     * Get Form with Attributes
     * 
     * @param Integer $formId
     * @return Html form 
     */
    public function getForm($formId) 
    {
        $fieldsData = $this->structureService->getFormAttributes($formId);
        return $fieldsData;
    }
}
