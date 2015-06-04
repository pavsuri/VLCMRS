<?php

use services\AttributeBuilderService;
use services\FieldTypesService;

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
        $this->attributeBuilderService->saveAttributes($fieldType, $name, $label, $value);
        $fieldsData = $this->fieldTypesService->getAllFields();
        return View::make('attributes.index', array('fields' => $fieldsData, 'msg' => 'Saved Successfully'));
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
}
