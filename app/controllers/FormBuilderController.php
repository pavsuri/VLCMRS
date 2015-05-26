<?php
use services\FormBuilderService;
use services\FieldTypesService;

class FormBuilderController extends \BaseController 
{

    private $formBuilderService;
    
    private  $fieldTypesService;
    
    public function __construct(FormBuilderService $formBuilderService,
                                FieldTypesService $fieldTypesService
                                )
     {
         $this->formBuilderService = $formBuilderService;
         $this->fieldTypesService = $fieldTypesService;
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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function addForm()
	{
        return View::make('forms.index');
	}
    
    /**
	 * Show the form for creating a new resource.
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
	 * Store a newly created resource in storage.
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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $formData = FormBuilder::find($id);
        echo "<pre>"; print_r($formData);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$forms = FormBuilder::find($id);
        $forms->name       = Input::get('formName');
        $forms->type_id      = Input::get('typeId');
        $forms->save();

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
