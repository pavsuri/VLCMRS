<?php
namespace services;

use models\Structure;
use repositories\StructureRepository;
use services\FormBuilderService;
use helpers\HtmlGenerator;

class StructureService
{
    private $structure;
    
    private $structureRepository;
    
    private $htmlGenerator;
    
    private $formBuilderService;
    
    public function __construct(Structure $strcture, StructureRepository $structureRepository, FormBuilderService $formBuilderService)
    {
        $this->structure = $strcture;
        $this->structureRepository = $structureRepository;
        $this->formBuilderService = $formBuilderService;
    }

    //Save Form Attributes
    public function saveFormAttributes($formId, $fieldId, $parentId = 0)
    {
        $form = $this->structure;
        $form->setFormId($formId);
        $form->setFieldId($fieldId);
        $form->setParentId($parentId);
        $form->save();
    }
    
    //Get form Name by Id
    public function getFormAttributes($formId)
    {
        $formData = $this->formBuilderService->getFormById($formId);
        $fieldsData = $this->structureRepository->getFormAttributes($formId);
        echo HtmlGenerator::htmlForm($formData->name, $formData->type_id);
        foreach ($fieldsData as $field) {
            echo  HtmlGenerator::htmlInput($field->fieldType, $field->fieldName, $field->fieldLabel, $field->fieldValue);
        }
        echo "</form>";
    }
}