<?php
namespace models;

class FieldTypes extends \Eloquent
{
    protected $table = 'field_types';
    
    private $name;
    
    public function setName($name)
    {
        $this->setParams('name', $name);
    }
    
    
    public function getName()
    {
        $this->getParams('name');
    }
    
    private function setParams($attributeKey, $attributeValue)
    {
        $this->attributes[$attributeKey] = $attributeValue; 
    }
    
    private function getParams($attributeKey)
    {
        $this->attributes[$attributeKey]; 
    }
    
}