<?php
namespace models;

class AssignedForms extends \Eloquent
{
    
    protected $table = 'assigned_forms';
    protected $fillable = array('user_id', 'form_type_id', 'assigned_form_id');
    
    private $user_id;
    private $category_id;
    private $formIds;
    
    public function setUserId($user_id)
    {
        $this->setParams('user_id', $user_id);
    }
    
    public function setCategoryId($category_id)
    {
        $this->setParams('form_type_id', $category_id);
    }
    
    public function setAssignedFormId($formIds)
    {
        $this->setParams('assigned_form_id', $formIds);
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