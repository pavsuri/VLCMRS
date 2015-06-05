<?php

namespace services;

use Hash;
use repositories\UserRepository;
use Illuminate\Auth\AuthManager;
use models\User;
use Redirect, Session;

class UserService   
{

    protected $repo;
    protected $session;
    protected $user;

    function __construct(UserRepository $repo, AuthManager $auth, User $user) 
    {
        $this->repo = $repo;
        $this->auth = $auth;
        $this->user = $user;
    }

    public function signIn($username, $password) 
    {
        $results = $this->auth->attempt(array('email' => $username, 'password' => $password));
        return $results;
    }
    
    public function addUser($email,$password, $name)
    {
        $password = Hash::make($password);
        $this->user->setEmail($email);
        $this->user->setName($name);
        $this->user->setPassword($password);
        $this->user->save();
    }
    
    public function getUser() {
        return $this->auth->user();
    }
    
    public function signout() {
        $this->auth->logout();
        Session::flush();
        return Redirect::to('login');
    }

}
