<?php
namespace models;

class FormTypes extends \Eloquent
{
    public $timestamps = false; 
    
    protected $table = 'form_types';
    
    protected $fillable = array('form_type');
    
    private $formType;
    
    public function setFormType($formType)
    {
        $this->setParams('form_type', $formType);
    }
    
    
    public function getFormType()
    {
        $this->getParams('form_type');
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
    public function formgenerators() {
        return $this->has_many('FormGenerator');
    }
    
    public function userforms() {
        return $this->has_many('UserForms');
    }
    
}