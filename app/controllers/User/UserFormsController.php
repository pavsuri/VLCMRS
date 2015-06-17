<?php
namespace Controllers\User;

use Illuminate\Support\Facades\Session;
use \services\User\UserFormsService;
use Illuminate\Support\Facades\Auth;
use services\FormBuilderService;
use Illuminate\Http\Request;
use \services\User\FormValuesService;
use \Illuminate\Support\Facades\Redirect;

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
     * Constructor.
     * 
     * @param UserFormsService $userFormsService
     * @param FormBuilderService $formBuilderService
     * @param Request $request
     * @param FormValuesService $formValuesService
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
        Session::put('formTypeId', $formTypeId);
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
        $formTypeId = Session::get('formTypeId');
        $userId = Auth::user()->id;
        $userFormId = $this->saveForm($userId, $formTypeId, $formId);
        //Check any files exist in Input data.
        $inputData = $this->checkFile($inputData);
        $this->formValuesService->saveFormValues($userFormId, $inputData);
        Session::put('formId', $formId);
        return Redirect::to('viewForm');
    }
    
    /**
     * Save User form Details.
     * 
     * @param Integer $userId
     * @param Integer $formTypeId
     * @param Integer $formId
     * @return Integer
     */
    private function saveForm($userId, $formTypeId, $formId)
    {
        $userFormExist = $this->userFormsService->checkUserForm($userId, $formId);
        if(count($userFormExist)>0) {
            $originatedFrom = $userFormExist->id;
            $version = $userFormExist->version+1;
            $status = 'versioned';
            $active = 0;
            $this->userFormsService->makeVersioned($userFormExist->id, $status, $active);
            $userFormId = $this->userFormsService->saveForm($userId, $formTypeId, $formId, $originatedFrom, $version, 'active', 1);
        } else {
            $originatedFrom = NULL;
            $version = 1;
            $status = 'active';
            $active = 1;
            $userFormId = $this->userFormsService->saveForm($userId, $formTypeId, $formId, $originatedFrom, $version, $status, $active);
        }
        return $userFormId;
    }
    
    /**
     * Get Form data by Form Id
     * 
     * @param Integer $formId
     */
    public function viewForm()
    {
        $formId = Session::get('formId');
        $userId = Auth::user()->id;
        $formInfo = $this->formBuilderService->getFormById($formId);
        $formValues = $this->userFormsService->getUserFormById($userId, $formId);
        $data = $this->formBuilderService->getFormsByType();
        Session::forget('formId');
        return \View::make('user.dashboard', array('formId'=> $formId, 'formInfo' => $formInfo ,'formTypes' => $data, 'formValues' => $formValues)); 
    }
    
    /**
     * Check file exist or not in Input Data.
     * If file exists upload file to Uplopads directory.
     * 
     * @param Array $inputData
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
    
    /**
     * Check uSer form Exist or not
     * 
     * @param Integer $formId
     */
    public function checkUserForm($formId)
    {
        $userId = Auth::user()->id;
        $result = $this->userFormsService->checkUserForm($userId, $formId);
        return json_encode($result);
    }
    
    /**
     * Get User Form Values 
     * @param type $formId
     */
    public function getUserFormValues($formId)
    {
        $userId = Auth::user()->id;
        $formData = $this->userFormsService->getUserFormById($userId, $formId);
        return $formData;
    }
}