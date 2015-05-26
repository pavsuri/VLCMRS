<?php
use services\AttributeBuilderService;
use services\FieldTypesService;

class AttributeBuilderController extends \BaseController 
{

    private $attributeBuilderService;
    
    private  $fieldTypesService;
    
    public function __construct(AttributeBuilderService $attributeBuilderService,
                                FieldTypesService $fieldTypesService
                                )
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
     */
    public function getAttributesByField($fieldId = 0)
    {
        if(strlen($fieldId) > 0) {
            $fieldAttributes = $this->attributeBuilderService->getAttributesByField($fieldId);
        }
        return $fieldAttributes;
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
        //
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        //
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
