<?php

namespace StickIt\Http\Controllers\Auth;

use StickIt\User;
use Validator;
use StickIt\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/notes';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // Sets message for regex password validator
        $messages = ['password.regex' => "Your password must contain 1 lower case character, 1 upper case character, and one number"];

        return Validator::make($data, [
            'name'                 => 'required|max:50',
            'email'                => 'required|email|max:255|unique:users',
            'password'             => 'required|confirmed|min:8|max:64|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
            'g-recaptcha-response' => 'required|recaptcha',
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        // Alert message for newly created user
        alert()->success('We have created a few examples for you to play with. We hope you enjoy what our site has to offer. Enjoy!', 'Welcome ' . $data['name'])->persistent('OK');

        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
