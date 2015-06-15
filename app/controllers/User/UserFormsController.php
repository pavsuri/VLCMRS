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
     * Save User Form Info and values
     */
    public function saveFormValues()
    {
        $inputData = $this->request->all();
        $formId = $inputData['formSubmitId'];
        $formTypeId = $inputData['formTypeSubmitId'];
        $userId = Auth::user()->id; 
        $userFormId = $this->userFormsService->saveForm($userId, $formTypeId, $formId);
        //Check any files exist in Input data.
        $inputData = $this->checkFile($inputData);
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
    
    /**
     * Check file exist or not in Input Data.
     * If file exists upload file to Uplopads directory.
     * 
     * @param type $inputData
     * @return string
     */
    private function checkFile($inputData)
    {
        foreach ($inputData as $key => $value) {
            $keyArr = explode('-', $key);
            if (count($keyArr) == 3) {
                if ($this->request->hasFile($key)) {
                    $destinationPath = 'uploads/';
                    $filename = $this->request->file($key)->getClientOriginalName();
                    $this->request->file($key)->move($destinationPath, $filename);
                } else {
                    $filename = '';
                }
                unset($inputData[$key]);
                $newKey = $keyArr[0].'-'.$keyArr[1];
                $inputData[$newKey] = $filename;
            }
        }
        return $inputData;
    }
}