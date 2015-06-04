<?php namespace services;

use Hash;
use repositories\UserRepository;
use Illuminate\Auth\AuthManager;

class UserService {

  protected $repo;
  protected $session;

  function __construct(UserRepository $repo, AuthManager $auth)
  {
    $this->repo = $repo;
    $this->auth = $auth;
  }

  public function signIn($username, $password) 
    {
      $results = $this->auth->attempt(array('email' => $username, 'password' => $password));
      return $results;
    }
}
