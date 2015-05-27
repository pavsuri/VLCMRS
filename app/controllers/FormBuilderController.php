<?php
use services\FormBuilderService;
use services\FieldTypesService;
use services\AttributeBuilderService;
use services\StructureService;
use classes\HtmlGenerator;

class FormBuilderController extends \BaseController 
{

    private $formBuilderService;
    
    private  $fieldTypesService;
    
    private  $attributeBuilderService;
    
    private  $structureService;
    
    private $htmlGenerator;
    
    
    public function __construct(FormBuilderService $formBuilderService,
                                FieldTypesService $fieldTypesService,
                                AttributeBuilderService $attributeBuilderService,
                                StructureService $structureService,
                                HtmlGenerator $htmlGenerator
                                )
     {
         $this->formBuilderService = $formBuilderService;
         $this->fieldTypesService = $fieldTypesService;
         $this->attributeBuilderService = $attributeBuilderService;
         $this->structureService = $structureService;
         $this->htmlGenerator = $htmlGenerator;
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
        return json_encode($message);
        //$data = $this->formBuilderService->getAllForms();
        //return View::make('forms.allForms', array('forms' => $data, 'message' => $message));
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
        $formData = $this->formBuilderService->getFormById($formId);
        $htmlForm[] = $this->htmlGenerator->htmlForm($formData->name, $formData->type_id);
        $fieldsData = $this->structureService->getFormAttributes($formId);
        foreach( $fieldsData as $field ) {
           $htmlForm[] =  $this->htmlGenerator->htmlInput($field->fieldType, $field->fieldName, $field->fieldLabel, $field->fieldValue);
        }
        $htmlForm[] = "</form>";
        for ($i=0; $i<count($htmlForm); $i++) {
            echo $htmlForm[$i] ."<br>";
        }
    }
}
