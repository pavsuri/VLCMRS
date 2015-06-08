<?php
namespace models;

class FieldTypes extends \Eloquent
{
    public $timestamps = false; 
    
    protected $table = 'field_types';
    
    protected $fillable = array('name');
    
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
    
    /*
     * Relations
     */
    public function attributegenerators() {
        return $this->has_many('AttributeGenerator'); // this matches the Eloquent model
    }
    
}