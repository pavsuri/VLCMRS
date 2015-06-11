<?php
namespace models;

class UserForms extends \Eloquent
{
    protected $table = 'user_forms';
    
    protected $fillable = array('form_type_id', 'user_id', 'form_id');
    
    private $formId;
    private $userId;
    private $formTypeId;
    
    public function setFormId($formId)
    {
        $this->setParams('form_id', $formId);
    }
    
    public function setFormTypetId($formTypeId)
    {
        $this->setParams('form_type_id', $formTypeId);
    }
    
    public function setUserId($userId)
    {
        $this->setParams('user_id', $userId);
    }
    
    public function getFormId()
    {
        $this->getParams('form_id');
    }
    
    public function getFormTypetId()
    {
        $this->getParams('form_type_id');
    }
    
    public function getUserId()
    {
        $this->getParams('user_id');
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
    public function formvalues()
    {
        return $this->has_many('FormValues');
    }
    
    public function users()
    {
        return $this->belongs_to('Users');
    }
    
    public function FormGenerator()
    {
        return $this->belongs_to('FormGenerator');
    }
    
    public function formTypes()
    {
        return $this->belongs_to('FormTypes');
    } 
}