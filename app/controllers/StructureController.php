<?php

use services\StructureService;
use services\FormBuilderService;
use services\FieldTypesService;
use services\AttributeBuilderService;
use services\FormTypesService;
use Illuminate\Support\Facades\Session;

class StructureController extends BaseController 
{
    /*
     * Structure Service
     * 
     * $structureService  Services\StructureService
     */
    private  $structureService;
    
    /**
     * Form Builder Service
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
     * FormTypesService 
     * 
     * FormTypesService services\FormTypesService
     */
    private $formTypesService;
    
    /**
     * Constructor
     * 
     * @param StructureService $structureService
     * @param FormBuilderService $formBuilderService
     * @param FieldTypesService $fieldTypesService
     * @param AttributeBuilderService $attributeBuilderService
     * @param FormTypesService $formTypesService
     */
    public function __construct(StructureService $structureService, 
                                FormBuilderService $formBuilderService,
                                FieldTypesService $fieldTypesService, 
                                AttributeBuilderService $attributeBuilderService, 
                                FormTypesService $formTypesService)
    {
        $this->structureService = $structureService;
        $this->formBuilderService = $formBuilderService;
        $this->fieldTypesService = $fieldTypesService;
        $this->attributeBuilderService = $attributeBuilderService;
        $this->formTypesService = $formTypesService;
    }
     
     /**
      * Save Form Field Attributes.
      * 
      * @param Integer $formId
      * @param Integer $fieldId
      * @param Integer $parentId
      * @return Object
      */
    public function saveFormAttributes($formId, $fieldId, $parentId = 0) 
    {
        return $this->structureService->saveFormAttributes($formId, $fieldId, $parentId);
    }
    
    /**
     * Assign fields to Form
     * 
     * @return Boolean
     */
    public function mapFieldsToForm()
    {
        $formId = Input::get('form_id_map');
        $fields = Input::get('allFields');
        $formLocation = Input::get('edit_form_id');
        Session::put('formMappedFields', $fields);
        $fields = array_keys($fields);
        //Delete all the form attributes
        $this->structureService->clearAllFields($formId);
        $this->structureService->mapFieldsToForm($formId, $fields);
        $formAttributesData = $this->structureService->getFormAttributes($formId);
        $formName = $this->formBuilderService->getFormById($formId);
        if ($formLocation == 1) {//Update form fields
            return View::make('forms.updateFormPreview',array('formData'=>$formAttributesData, 'formProfile' =>$formName));
        } else {//While create new form
             return View::make('forms.preview',array('formData'=>$formAttributesData));
        }
    }
    
    /**
     * Edit Form Fields
     */
    public function editFormFields()
    {
        $formFields = array();
        $formId = Input::get('formEditId');
        $fieldsLibrary = $this->attributeBuilderService->getAttributesByField();
        $formTypes = $this->formTypesService->getFormTypes();
        $fieldTyps = $this->fieldTypesService->getAllFields();
        $mappedFields = $this->structureService->getFormFields($formId);
        foreach($mappedFields as $field)
        {
            $formFields[$field->id] = $field->name;
        }
        $formData = $this->formBuilderService->getFormById($formId);
        $formList = $this->formBuilderService->listFormsByTypeId();
        $data = array('formName'=>$formData->name, 
                    'formType' => $formData->type_id,
                    'formId' => $formId, 
                    'fieldsLibrary' => $fieldsLibrary,
                    'fieldTypes' => $fieldTyps, 
                    'mappedFields' => $formFields,
                    'formsData' => $formList);
        return View::make('forms.editMapping', array('data' => $data, 'formTypes' => $formTypes));
    }
}