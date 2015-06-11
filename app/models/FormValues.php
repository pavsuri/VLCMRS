<?php
namespace models;

class FormValues extends \Eloquent
{
    public $timestamps = false; 
    protected $table = 'form_values';
    
    protected $fillable = array('user_form_id', 'uuid', 'value');
    
    private $userFormId;
    private $uuid;
    private $value;
    
    public function setUserFormId($userFormId)
    {
        $this->setParams('user_form_id', $userFormId);
    }
    
    public function setUuid($uuid)
    {
        $this->setParams('uuid', $uuid);
    }
    
    public function setValue($value)
    {
        $this->setParams('value', $value);
    }
    
    public function getUserFormId()
    {
        $this->getParams('user_form_id');
    }
    
    public function getUuid()
    {
        $this->getParams('uuid');
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
     * Relations..
     */
    
    public function userforms()
    {
        return $this->belongs_to('UserForms');
    }
}