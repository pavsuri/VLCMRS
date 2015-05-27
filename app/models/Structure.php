<?php
namespace models;

class Structure extends \Eloquent
{
    public $timestamps = false; 
    protected $table = 'structure';
    
    protected $fillable = array('form_id', 'parent_id', 'field_id');
    
    private $formId;
    private $parentId;
    private $fieldId;
    
    public function setFormId($formId)
    {
        $this->setParams('form_id', $formId);
    }
    
    public function setParentId($parentId)
    {
        $this->setParams('parent_id', $parentId);
    }
    
    public function setFieldId($fieldId)
    {
        $this->setParams('field_id', $fieldId);
    }
    
    public function getFormId()
    {
        $this->getParams('form_id');
    }
    
    public function getParentId()
    {
        $this->getParams('parent_id');
    }
    
    public function getFieldId()
    {
        $this->getParams('field_id');
    }
    
    private function setParams($attributeKey, $attributeValue)
    {
        $this->attributes[$attributeKey] = $attributeValue; 
    }
    
    private function getParams($attributeKey)
    {
        $this->attributes[$attributeKey]; 
    }
    
    /**
     * Relations..
     */
    
    public function attributegenerator()
    {
        return $this->belongs_to('AttributeGenerator');
    }
    
    public function formgenerator()
    {
        return $this->belongs_to('FormGenerator');
    }
    
}