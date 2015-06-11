<?php

use services\FormBuilderService;
use services\FieldTypesService;
use services\AttributeBuilderService;
use services\StructureService;
use services\FormTypesService;
use Illuminate\Support\Facades\Session;

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
                                FormTypesService $formTypesService
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
     * Save new form to form table.
     *
     * @return Response
     */
    public function saveForm() 
    {
        $name = Input::get('name');
        $typeId = Input::get('type_id');
        $version = 1;
        $status = 'active';
        $active = 1;
        /* $formExist = $this->formBuilderService->formExist($name);
        if ($formExist) {
            return Redirect::to('/addForm')->with('errMsg','Form Name Already exist!');
        } else { */
        $formId = $this->formBuilderService->addForm($name, $typeId, $version, $status, $active);
        Session::put('formId', $formId);
        Session::put('formName', $name);
        Session::put('typeId', $typeId);
        $fieldsLibrary = $this->attributeBuilderService->getAttributesByField();
        $formTypes = $this->formTypesService->getFormTypes();
        $fieldTyps = $this->fieldTypesService->getAllFields();
        $data = array('formName'=>$name, 'formType' => $typeId, 'formId' => $formId, 'fieldsLibrary' => $fieldsLibrary, 'fieldTypes' => $fieldTyps);
        return View::make('forms.addFieldsToForm', array('data' => $data, 'formTypes' => $formTypes));
        //}
    }
    
    /**
     * Edit Form
     */
    public function updateForm()
    {
        $formId = Input::get('formId');
        $existedFormData = $this->formBuilderService->getFormById($formId);
        $name = Input::get('formName');
        $typeId = Input::get('formType');
        $version = $existedFormData->version;
        $status = $existedFormData->status;
        $originatedFrom = $existedFormData->originated_from;
        $active = $existedFormData->active;
        return $this->formBuilderService->updateForm($formId, $name, $typeId, $version, $status, $active, $originatedFrom);
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
        return View::make('forms.preview',array('formData'=>$fieldsData));
    }
    
    /**
     * Form Preview
     * 
     * @param Integer $formId 
     * @return Array Description
     */
    public function preview($formId) 
    {
        $fieldsData = $this->structureService->getFormAttributes($formId);
        return $fieldsData;
    }
    
    /**
     * DashBorad
     */
    public function dashboard()
    {
        $formTypesCount = $this->formBuilderService->getFormsByType();
        return View::make('dashboard', array('forms' => $formTypesCount));
    }
    
    /**
     * List of Forms
     * 
     * @param Integer $formTypeId 
     */
    public function formList($formTypeId)
    {
        $data = $this->formBuilderService->listFormsByTypeId($formTypeId);
        return View::make('forms.allForms', array('forms' => $data));
    }
    
    /**
     * Get Form Name
     * 
     * @param Integer $formId 
     */
    public function getFormDetails($formId)
    {
        return $this->formBuilderService->getFormById($formId);
    }
    
    /**
     * Delete Form
     * 
     * @param Integer $formId 
     */
    public function deleteForm($formId)
    {
        //Destroy Form Fields Library while move to back page.
        Session::forget('formMappedFields');
        return $this->formBuilderService->deleteForm($formId);
    }
    
    /**
     * Back to Mapping page
     */
    public function mapFields()
    {
        $formId = Session::get('formId');
        //Delete all Form Fields.
        $this->structureService->clearAllFields($formId);
        $fieldsLibrary = $this->attributeBuilderService->getAttributesByField();
        $formTypes = $this->formTypesService->getFormTypes();
        $fieldTyps = $this->fieldTypesService->getAllFields();
        $formName = Session::get('formName');
        $typeId = Session::get('typeId');
        $mappedFields = Session::get('formMappedFields');
        $data = array('formName'=>$formName, 'formType' => $typeId, 'formId' => $formId, 'fieldsLibrary' => $fieldsLibrary, 'fieldTypes' => $fieldTyps, 'mappedFields' => $mappedFields);
        return View::make('forms.addFieldsToForm', array('data' => $data, 'formTypes' => $formTypes));
    }
    
    /**
     * View Forms
     */
    public function viewForms()
    {
        $formsData = $this->formBuilderService->listFormsByTypeId();
        return View::make('forms.viewForms', array('formsData' => $formsData));
    }
    
    /**
     * Check Form Exist or Not
     */
    public function formExistStatus($formName, $formId)
    {
        $formExist = $this->formBuilderService->formExist($formName, $formId);
        if ($formExist) {
            return 1;
        } else {
            return 0;
        }
    }
}
