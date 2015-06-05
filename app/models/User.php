<?php
namespace models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

  use UserTrait, RemindableTrait;

  protected $fillable = [
    'email',
    'password',
    'name',
    'create_at',
    'updated_at'
  ];

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = array('password');
    /**
    * Get the unique identifier for the user.
    *
    * @return mixed
    */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
    * Get the password for the user.
    *
    * @return string
    */
    public function getAuthPassword()
    {
        return $this->password;
    }
    /**
    * Get the e-mail address where password reminders are sent.
    *
    * @return string
    */
    public function getReminderEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->setParams('email', $email);
    }
    
    public function setPassword($password)
    {
        $this->setParams('password', $password);
    }
    
    public function setName($name)
    {
        $this->setParams('name', $name);
    }
    
    public function getName()
    {
        $this->getParams('name');
    }
    
    public function getEmail()
    {
        $this->getParams('email');
    }
    
    private function setParams($attributeKey, $attributeValue)
    {
        $this->attributes[$attributeKey] = $attributeValue; 
    }
    
    private function getParams($attributeKey)
    {
        $this->attributes[$attributeKey]; 
    }
    
    //Remove remember_token
    public function getRememberToken() {
        return null; // not supported
    }

    public function setRememberToken($value) {
        // not supported
    }

    public function getRememberTokenName() {
        return null; // not supported
    }

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value) {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }

}
