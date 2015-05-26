<?php
namespace services;

use models\Structure;
use repositories\StructureRepository;

class StructureService
{
    private $structure;
    
    private $structureRepository;
    
    public function __construct(Structure $strcture, StructureRepository $structureRepository)
    {
        $this->structure = $strcture;
        $this->structureRepository = $structureRepository;
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
        $formData = $this->structureRepository->getFormAttributes($formId);
        return $formData;
    }
}