<?php
namespace models;

class FormGenerator extends \Eloquent
{
    protected $table = 'forms';
    
    private $name;
    private $type_id;
    
    protected $fillable = array('name', 'type_id');
    
    public function setName($name)
    {
        $this->setParams('name', $name);
    }
    
    public function setTypeId($type_id)
    {
        $this->setParams('type_id', $type_id);
    }
    
    public function getName()
    {
        $this->getParams('name');
    }
    
    public function getTypeId()
    {
        $this->getParams('type_id');
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
    public function structures() {
        return $this->has_many('Structure'); // this matches the Eloquent model
    }
    public function formtypes() {
        return $this->belongs_to('FormTypes'); // this matches the Eloquent model
    }
}