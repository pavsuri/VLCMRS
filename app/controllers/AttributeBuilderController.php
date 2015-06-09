<?php

use services\AttributeBuilderService;
use services\FieldTypesService;
use Illuminate\Support\Facades\Redirect;

class AttributeBuilderController extends \BaseController 
{

    /**
     * AttributeBuilderService
     */
    private $attributeBuilderService;
    
    /**
     *FieldTypesService
     */
    private $fieldTypesService;

    /**
     * Constructor.
     * 
     * @param AttributeBuilderService $attributeBuilderService
     * @param FieldTypesService $fieldTypesService
     */
    public function __construct(AttributeBuilderService $attributeBuilderService, FieldTypesService $fieldTypesService)
    {
        $this->attributeBuilderService = $attributeBuilderService;
        $this->fieldTypesService = $fieldTypesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() 
    {
        $fieldsData = $this->fieldTypesService->getAllFields();
        return View::make('attributes.index', array('fields' => $fieldsData));
    }

    /**
     * Get all Attributes and save to repo.
     * 
     * @return type
     */
    public function saveAttributes() 
    {
        $fieldType = Input::get('field_type');
        $name = Input::get('field_name');
        $label = Input::get('field_label');
        $value = Input::get('field_value');
        return $this->attributeBuilderService->saveAttributes($fieldType, $name, $label, $value);
    }

    /**
     * Get all Attributes by Field Id
     * 
     * @param Integer $fieldId
     */
    public function getAttributesByField($fieldId = 0) 
    {
        if (strlen($fieldId) > 0) {
            $fieldAttributes = $this->attributeBuilderService->getAttributesByField($fieldId);
        }
        return $fieldAttributes;
    }
    
    /**
     * Search Attributes from Library
     */
    public function searchFieldLibrary()
    {
        $attributeKeyword = Input::get('attributeKeyword');
        $fieldTypeId = Input::get('fieldTypeId');
        return $this->attributeBuilderService->searchFieldLibrary($attributeKeyword, $fieldTypeId);
    }
   
    /**
     * Move fields from left to Form
     * 
     * @param Integer $fieldId
     * @return Object
     */
    public function moveField($fieldId)
    {
        $results = $this->attributeBuilderService->getField($fieldId);
        return $results;
    }
    
    /**
     * Load create new fields page
     * 
     * @return HTML
     */
    public function createFields()
    {
        $fieldTyps = $this->fieldTypesService->getAllFields();
        return View::make('forms.createFields', array('fieldTypes' => $fieldTyps));
    }
    
    /**
     * Save New Attributes from page
     */
    public function saveFieldsToLibrary()
    {
        $results = $this->saveAttributes();
        Session::flash('message', 'Successfully save in our Fields Library');
        return Redirect::to('createFields')->withInput();
    }
}
