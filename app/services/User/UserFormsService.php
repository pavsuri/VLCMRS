<?php
namespace services\User;

use models\UserForms;
use repositories\User\UserFormsRepository;
use repositories\StructureRepository;
use Illuminate\Support\Facades\DB;
use helpers\UserFormHtmlGenerator;


class UserFormsService
{
    /**
     *UserForms Model $userForms
     */
    private $userForms;

    /**
     * UserFormRepository $userFormRepository
     */
    private $userFormRepository;
    
    /**
     *Structure Repository StructureRepository
     */
    private $structureRepository;
    
    /**
     * Constructor.
     * 
     * @param UserForms $userForms
     */
    public function __construct(UserForms $userForms, UserFormsRepository $userFormRepository, StructureRepository $structureRepository)
    {
        $this->userForms = $userForms;
        $this->userFormRepository = $userFormRepository;
        $this->structureRepository = $structureRepository;
    } 
    
    /**
     * Get Form data by Form Id
     * 
     * @param Integer $formId
     * @return Object
     */
    public function getFormAttributes($formId)
    {
        $fieldsData = $this->structureRepository->getFormAttributes($formId);
        $fieldsHierarchicalData = $this->buildTree($fieldsData);
        return $this->hemlGeneratorEdit($fieldsHierarchicalData);
    }
    
    /**
     * Generate Heirarchical structure.
     * 
     * @param array $elements
     * @param Integer $parentId
     * @return array
     */
    private function buildTree(array $elements, $parentId = 0) 
    {
        $branch = array();  
        foreach ($elements as $element) {
            if ($element->parent_id == $parentId) {
                $children = $this->buildTree($elements, $element->field_id);
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
    
    /**
     * Generate Html.
     * 
     * @param Array $fieldsHierarchicalData
     * @return HTML Output
     */
    private function hemlGeneratorEdit($fieldsHierarchicalData)
    { 
        $field = $fieldsHierarchicalData;
        $optionsData =  array();
        $formHtmlDesign = "";
        for($i=0; $i<count($field); $i++) {
            if (isset($field[$i]->children)) {
                if (($field[$i]->fieldType == 'selectbox') || ($field[$i]->fieldType == 'checkbox') || ($field[$i]->fieldType == 'radiobutton')) {
                    $optionsData = $field[$i]->children;
                    $formHtmlDesign .= UserFormHtmlGenerator::htmlInput($field[$i], $optionsData);
                } else {
                    $formHtmlDesign .= UserFormHtmlGenerator::htmlInput($field[$i], $optionsData);
                    $containerData = $field[$i]->children;
                    if (isset($containerData)) { 
                       $this->hemlGenerator($containerData);
                    }
                }
            } else {
                $optionsData = array();
                $formHtmlDesign .= UserFormHtmlGenerator::htmlInput($field[$i], $optionsData);
            }
            if( (($i+1)%3 == 0)){
                $formHtmlDesign .= '<div class="clearfix visible-lg-block"></div>';
            }
        }
        $formHtmlDesign .= "</form>"; 
        return $formHtmlDesign;
    }
    
    /**
     * Save Form data.
     * 
     * @param Integer $userId
     * @param Integer $formTypeId
     * @param Integer $formId
     * @return Integer
     */
    public function saveForm($userId, $formTypeId, $formId, $originatedFrom, $version, $status, $active)
    {
        $userForm = $this->userForms;
        $userForm->setFormId($formId);
        $userForm->setFormTypetId($formTypeId);
        $userForm->setUserId($userId);
        $userForm->setOriginatedFrom($originatedFrom);
        $userForm->setVersion($version);
        $userForm->setStatus($status);
        $userForm->setActive($active);
        $userForm->save();
        return $userForm->id;
    }
    
    /**
     * Check form has been submitted by same user or not
     * @param Integer $userId
     * @param Integer $formId
     * @return Object
     */
    public function checkUserForm($userId, $formId)
    {
        return $this->userFormRepository->checkUserForm($userId, $formId);
    }
    
    /**
     * User form Make versioned
     */
    public function makeVersioned($userFormid, $status, $active)
    {
        $userForm = $this->userForms;
        $userForm = $userForm->find($userFormid);
        $userForm->setStatus($status);
        $userForm->setActive($active);
        $userForm->update();
    }
    
    /**
     * Get form Structure and Values.
     * 
     * @param Integer $userId
     * @param Integer $formId
     * @return type
     */
    public function getUserFormById($userId, $formId)
    {
        $formStructure = $this->getFormStructure($formId);
        $userFormInfo = $this->userFormRepository->getUserFormById($userId, $formId);
        $formData = $this->buildFormStructure($formStructure, $userFormInfo);
        return $formData;
    }
    
    /**
     * Get Form Structure which includes Attributes.
     * 
     * @param $formId $formId
     * @return Object
     */
    private function getFormStructure($formId)
    {
        $fieldsData = $this->structureRepository->getFormStructure($formId);
        return $fieldsData;
    }
    
    /**
     * Assign null values if empty values to fields.
     * 
     * @param type $formStructure
     * @param type $userFormInfo
     * @return type
     */
    private function buildFormStructure($formStructure, $userFormInfo)
    {
        foreach ($formStructure as &$a1val) {
            $value = 0;
            foreach ($userFormInfo as $a2val) {
                if(isset($a1val->uuid)) {
                    if ($a1val->uuid == $a2val->uuid) {
                        $value = $a2val->value;
                        break;
                    }
                }
            }
            $a1val->value = $value;
        }
        return $formStructure;
    }
}