<?php
namespace models;

class FormTypes extends \Eloquent
{
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
        return $this->has_many('FormGenerator'); // this matches the Eloquent model
    }
    
}