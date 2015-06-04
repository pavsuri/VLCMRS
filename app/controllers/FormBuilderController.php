<?php

use services\FormBuilderService;
use services\FieldTypesService;
use services\AttributeBuilderService;
use services\StructureService;
use services\FormTypesService;

class FormBuilderController extends \BaseController 
{
    /**
     * Form builder Service 
     * 
     * $formBuilderService services\FormBuilderService
     */
    private $formBuilderService;
    
    /**
     * Field Type Service
     * 
     * $fieldTypesService services\FieldTypesService 
     */
    private $fieldTypesService;
    
    /**
     * Field Attruibute library
     * 
     * $attributeBuilderService services\AttributeBuilderService
     */
    private $attributeBuilderService;
    
    /**
     * Structure Service
     * 
     * $structureService services\StructureService
     */
    private $structureService;
    
    /**
     * FormTypesService 
     * 
     * FormTypesService services\FormTypesService
     */
    private $formTypesService;
    
    /**
     * Constructor 
     * 
     * @param FormBuilderService $formBuilderService
     * @param FieldTypesService $fieldTypesService
     * @param AttributeBuilderService $attributeBuilderService
     * @param StructureService $structureService
     * @param FormTypesService $formTypesService
     */
    

    public function __construct(FormBuilderService $formBuilderService, 
                                FieldTypesService $fieldTypesService, 
                                AttributeBuilderService $attributeBuilderService, 
                                StructureService $structureService,
                                services\FormTypesService $formTypesService
                                ) 
    {
        $this->formBuilderService = $formBuilderService;
        $this->fieldTypesService = $fieldTypesService;
        $this->attributeBuilderService = $attributeBuilderService;
        $this->structureService = $structureService;
        $this->formTypesService = $formTypesService;
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
        $data = $this->formTypesService->getFormTypes();
        return View::make('forms.index', array('formTypes' => $data));
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
        $formId = $this->formBuilderService->addForm($name, $typeId);
        $fieldsLibrary = $this->attributeBuilderService->getAttributesByField();
        $formTypes = $this->formTypesService->getFormTypes();
        $fieldTyps = $this->fieldTypesService->getAllFields();
        $data = array('formName'=>$name, 'formType' => $typeId, 'formId' => $formId, 'fieldsLibrary' => $fieldsLibrary, 'fieldTypes' => $fieldTyps);
        return View::make('forms.addFieldsToForm', array('data' => $data, 'formTypes' => $formTypes));
    }
    
    /**
     * Edit Form
     */
    public function updateForm()
    {
        $formId = Input::get('formId');
        $name = Input::get('formName');
        $typeId = Input::get('formType');
        return $this->formBuilderService->updateForm($formId, $name, $typeId);
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
