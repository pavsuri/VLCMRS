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
                $formHtmlDesign .= UserFormHtmlGenerator::htmlInput($field[$i], $optionsData);
            }
            if( (($i+1)%3 == 0)){
                $formHtmlDesign .= '<div class="clearfix visible-lg-block"></div>';
            }
        }
        $formHtmlDesign .= "</form>"; 
        return $formHtmlDesign;
    }

}