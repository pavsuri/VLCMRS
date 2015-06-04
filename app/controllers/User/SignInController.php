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

    public function perform() 
    {
        $email = Input::get('email');
        $password = Input::get('password');
        if ($this->user->signIn($email, $password)) {
            // redirect to the intended destination
            return Redirect::intended($intended);
        } else {
            echo "false"; exit;
        }
        //Session::flash('failed', true);
        //return Redirect::to('signin')->withInput();
    }

}
