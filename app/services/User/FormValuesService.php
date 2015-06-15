<?php
namespace services\User;

use models\FormValues;
use helpers\UserFormHtmlGenerator;
use repositories\User\FormValuesRepository;

class FormValuesService
{
    /**
     *UserForms Model $userForms
     */
    private $formValues;
    
    /**
     * FormValueRepository $formValueRepository
     */
    private $formValuesRepository;
    
   /**
     * Constructor.
     * 
     * @param UserForms $userForms
     */
    public function __construct(FormValues $formValues, FormValuesRepository $formValuesRepository)
    {
        $this->formValues = $formValues;
        $this->formValuesRepository = $formValuesRepository;
    }    

    /**
     * Save Form values
     * 
     * @param Integer $userFormId
     * @param Array $formValues
     */
    public function saveFormValues($userFormId, $formData)
    {
        $finalData = $this->structureData($formData);
        for ($i=0; $i<count($finalData['uuid']); $i++){
            $formValues = new FormValues();
            $formValues->setUserFormId($userFormId);
            $formValues->setUuid($finalData['uuid'][$i]);
            $formValues->setValue($finalData['value'][$i]);
            $formValues->save();
        }
    }
    
    /**
     * Clean Array and prepare structure.
     * 
     * @param Array $finalData
     * @return type
     */
    private function structureData($formData)
    {
        $finalData = array();
        $checkValues = '';
        //Remove Token, formId, formtype id.
        $formValues = array_slice($formData, 1, -2);
        foreach ($formValues as $key => $value) {
            $keyArr = explode('-', $key);
            $finalData['fieldType'][] = $keyArr[0];
            $finalData['uuid'][] = $keyArr[1];
            if (is_array($value)) {
                for($k=0; $k<count($value); $k++){
                    $checkValues .= $value[$k].'|';
                }
                $value = trim($checkValues, '|');
            }
            $finalData['value'][] = $value;
        }
        return $finalData;
    }
}