<?php
namespace Controllers\User;

use Illuminate\Support\Facades\Session;
use \services\User\UserFormsService;
use Illuminate\Support\Facades\Auth;
use services\FormBuilderService;
use Illuminate\Http\Request;
use \services\User\FormValuesService;

class UserFormsController extends \BaseController
{
    /*
     * Structure Service
     * 
     * $structureService  Services\StructureService
     */
    private  $userFormsService;
    
    /**
     * Form builder Service 
     * 
     * $formBuilderService services\FormBuilderService
     */
    private $formBuilderService;
    
    /**
     * FormValuesService $formValuesService
     */
    private $formValuesService;
    
    /**
     * Http Request $request;
     */
    private $request;
    
    /**
     * FormValuesService $formValuesService
     */
    
    /**
     * Constructor
     * 
     * @param FormBuilderService $formBuilderService
     */
    public function __construct(UserFormsService $userFormsService, FormBuilderService $formBuilderService, Request $request, FormValuesService $formValuesService)
    {
        $this->userFormsService = $userFormsService;
        $this->formBuilderService = $formBuilderService;
        $this->request = $request;
        $this->formValuesService = $formValuesService;
    }
    
    /**
     * User DashBoard.
     * 
     * @return type
     */
    public function dashboard()
    {
        $data = $this->formBuilderService->getFormsByType();
        return \View::make('user.dashboard', array('formTypes' => $data));
    }
    
    /**
     * Get List of forms by Type
     * 
     * @param Integer $formTypeId
     * @return type
     */
    public function getFormsByTypeId($formTypeId)
    {
        $forms = $this->formBuilderService->listFormsByTypeId($formTypeId);
        return $forms;
    }
    
    /**
     * Get Html Template
     * 
     * @param Integer $formId
     * @return type
     */
    public function getFormHtml($formId)
    {
        $htmlForm = $this->userFormsService->getFormAttributes($formId);
        return $htmlForm;
    }
    
    /**
     * Save Form values
     */
    public function saveFormValues()
    {
        $inputData = $this->request->all();
        $formId = $inputData['formSubmitId'];
        $formTypeId = $inputData['formTypeSubmitId'];
        $userId = Auth::user()->id; 
        $userFormId = $this->userFormsService->saveForm($userId, $formTypeId, $formId, $inputData);
        $this->formValuesService->saveFormValues($userFormId, $inputData);
        $formInfo = $this->formBuilderService->getFormById($formId);
        $formValues = $this->userFormsService->getUserFormById($userId, $formId);
        $data = $this->formBuilderService->getFormsByType();
        return \View::make('user.formData', array('formInfo' => $formInfo ,'formTypes' => $data, 'formValues' => $formValues)); 
    }
    
    /**
     * Get Form data by Form Id
     * @param Integer $formId
     */
    public function viewForm($formId)
    {
        $userId = Auth::user()->id;
        $formInfo = $this->formBuilderService->getFormById($formId);
        $formValues = $this->userFormsService->getUserFormById($userId, $formId);
        $data = $this->formBuilderService->getFormsByType();
        return \View::make('user.formData', array('formInfo' => $formInfo ,'formTypes' => $data, 'formValues' => $formValues)); 
    }
     
}