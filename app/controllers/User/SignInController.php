<?php
namespace User;

use services\UserService;
use Input, Redirect, Session, View;
use Illuminate\Support\Facades\Hash;

class SignInController extends \BaseController 
{
    protected $user;

    function __construct(UserService $user) 
    {
        $this->user = $user;
    }

    public function index()
    {
        return \View::make('user.signin');
    }

    //User Login action
    public function perform() 
    {
        $email = Input::get('email');
        $password = Input::get('password');
        if ($this->user->signIn($email, $password)) {
            $user = $this->user->getUser();
            Session::put('userName', $user->name);
            return Redirect::to('dashboard');
        } else {
            Session::flash('failedMsg', 'Username/Password mismatch');
            return Redirect::to('login')->withInput();
        }
       
    }
    
    //Add new User
    public function addUser()
    {
        $email = Input::get('email');
        $password = Input::get('password');
        $name = Input::get('name');
        $roleId = Input::get('roleId'); //1-Admin, 2-User
        $this->user->addUser($email, $password, $name, $roleId);       
    }
    
    public function signout()
    {
        return $this->user->signout();
    }

}
