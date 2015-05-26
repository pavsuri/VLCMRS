<?php
use services\FormBuilderService;
use services\FieldTypesService;
use services\AttributeBuilderService;
use services\StructureService;

class FormBuilderController extends \BaseController 
{

    private $formBuilderService;
    
    private  $fieldTypesService;
    
    private  $attributeBuilderService;
    
    private  $structureService;
    
    
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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = $this->formBuilderService->getAllForms();
        return View::make('forms.allForms', array('forms' => $data));
	}


	/**
	 * Default page. Shows all forms
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
        return View::make('forms.addFieldsToForm', array('formData' => $formData, 'fields' => $fieldsData ));
	}


	/**
	 * Save form to form table.
	 *
	 * @return Response
	 */
	public function saveForm()
	{
		$name = Input::get('name');
        $typeId = Input::get('type_id');
        $this->formBuilderService->addForm($name, $typeId);
        $message = "Successfully saved in our database";
        $data = $this->formBuilderService->getAllForms();
        return View::make('forms.allForms', array('forms' => $data, 'message' => $message));
    }

    /**
     * Save Form Field Attributes
     */
    public function saveFormAttributes($formId, $fieldId, $parentId = 0) 
    {
        return $this->structureService->saveFormAttributes($formId, $fieldId, $parentId);
    }
    
    /**
     * Get Form with Attributes
     */
    public function getFormAttributes($formId)
    {
        $formData = $this->structureService->getFormAttributes($formId);
        echo "<pre>"; print_r($formData);
    }
}
