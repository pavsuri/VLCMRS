<?php
namespace models;

use Illuminate\Support\Facades\Validator;

class FormGenerator extends \Eloquent
{
    protected $table = 'forms';
    
    private $name;
    private $type_id;
    
    protected $fillable = array('name', 'type_id', 'originated_from', 'version', 'status', 'active' );
    
    public function setName($name)
    {
        $this->setParams('name', $name);
    }
    
    public function setTypeId($type_id)
    {
        $this->setParams('type_id', $type_id);
    }
    
    public function setOriginatedFrom($originatedFrom)
    {
        $this->setParams('originated_from', $originatedFrom);
    }
    
    public function setVersion($version)
    {
        $this->setParams('version', $version);
    }
    
    public function setStatus($status)
    {
        $this->setParams('status', $status);
    }
    
    public function setActive($active)
    {
        $this->setParams('active', $active);
    }
    
    public function getName()
    {
        $this->getParams('name');
    }
    
    public function getTypeId()
    {
        $this->getParams('type_id');
    }
    
    public function getOriginatedFrom()
    {
        $this->getParams('originated_from');
    }
    
    public function getVersion()
    {
        $this->getParams('version');
    }

    public function getStatus()
    {
        $this->getParams('status');
    }
    
    public function getActive()
    {
        $this->getParams('active');
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