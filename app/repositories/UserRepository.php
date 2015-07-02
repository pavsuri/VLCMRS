<?php

namespace repositories;

use models\User;

class UserRepository extends AbstractBaseRepository 
{

    /**
     * User model
     *
     * @var mixed
     */
    protected $model;

    /**
     * Constructor
     * 
     * @param User $model
     */
    function __construct(User $model) {
        $this->model = $model;
    }

    public function getAll() 
    {
        return $this->build(
                        $this->load('roles')->get()
        );
    }

    public function getByEmail($email) 
    {
        return $this->build(
                        $this->load('roles')
                                ->where('email', $email)
                                ->get()
        );
    }

    public function getById($id) 
    {
        return $this->build(
                        $this->load('roles')->find($id)
        );
    }
    
    public function getUsers() 
    {
        $results = $this->build(
                        $this->model->select ('id','name')
                                    ->where('is_active', 1)
                                    ->get()
        );
        return $results;        
    }

}
