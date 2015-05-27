<?php
namespace models;

class AttributeGenerator extends \Eloquent
{
    protected $table = 'field_attributes';
    
    public $timestamps = false; 
    private $field_type_id;
    private $name;
    private $label;
    private $value;
    
    protected $fillable = array('field_type_id', 'name', 'label', 'value');
    
    public function setFieldTypeId($field_type_id)
    {
        $this->setParams('field_type_id', $field_type_id);
    }
        
    public function getFieldTypeId()
    {
        $this->getParams('field_type_id');
    }
    
   
    public function setName($name)
    {
        $this->setParams('name', $name);
    }
        
    public function getName()
    {
        $this->getParams('name');
    }
    
     public function setLabel($label)
    {
        $this->setParams('label', $label);
    }
        
    public function getLabel()
    {
        $this->getParams('label');
    }
    
    
    public function setValue($value)
    {
        $this->setParams('value', $value);
    }
        
    public function getValue()
    {
        $this->getParams('value');
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
     * Relations
     */
    public function fieldtypes()
    {
        return $this->belongs_to('FieldTypes');
    }
    
    public function structures()
    {
        return $this->has_many('Structure');
    }
}