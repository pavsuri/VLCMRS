<?php
namespace models;

class FieldGroups extends \Eloquent
{
    protected $table = 'field_groups';
    public $timestamps = false; 
    protected $fillable = array('field_id', 'name', 'value');
    
    private $filedId;
    private $name;
    private $value;
    
    public function setFieldId($fieldId)
    {
       return $this->setParams('field_id', $fieldId);
    }
    
    public function setName($name)
    {
       return $this->setParams('name', $name);
    }
    
    public function setValue($value)
    {
       return  $this->setParams('value', $value);
    }
    
     public function getFieldId()
    {
        $this->getParams('field_id');
    }
    
    public function getName()
    {
        $this->setParams('name');
    }
    
    public function getValue()
    {
        $this->getParams('value');
    }
    
   
    private function setParams($attributeKey, $attributeValue)
    {
        return $this->attributes[$attributeKey] = $attributeValue; 
    }
    
    private function getParams($attributeKey)
    {
        return $this->attributes[$attributeKey]; 
    }
    
    /*
     * Relations
     */
    public function structure() {
        return $this->belongs_to('Structure'); // this matches the Eloquent model
    }
    
}