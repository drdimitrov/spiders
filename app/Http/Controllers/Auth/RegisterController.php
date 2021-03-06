<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserRequestedActivationEmail;
use App\Http\Controllers\Controller;
use App\Services\Newsletter\Exceptions\UserAlreadySubscribedException;
use App\Services\Newsletter\NewsletterContract;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function register(Request $request, NewsletterContract $newsletter)
    {
        $this->validator($request->all())->validate();

        if($request->newsletter){
            try{
                $newsletter->subscribe(
                    env('MAILCHIMP_LIST'), 
                    $request->email,
                    ['FNAME' => $request->name]
                );
            }catch(UserAlreadySubscribedException $e){
                return back()->withInput()->withErrors([
                    'newsletter' => $e->getMessage()
                ]);
            }
        }
        
        event(new Registered($user = $this->create($request->all())));

        event(new UserRequestedActivationEmail($user));
        //$this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath())->withSuccess('Registered successfully. Please, check your email to activate your account.');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'title' => isset($data['title']) ? $data['title'] : null,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active' => false,
            'activation_token' => str_random(150),
        ]);
    }
}
