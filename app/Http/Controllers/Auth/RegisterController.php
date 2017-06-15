<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Mail;
use Session;

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
    protected $redirectTo = '/register/verify';

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
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        Session::flash('massage', 'Please verify your email!!!');
        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'token'     => md5(time())
        ]);
    }


    protected function verification()
    {

        if (Auth::user()->confirm == 0) {
            $token = Auth::user()->token;
            $email = Auth::user()->email;
            $url = env('APP_URL', 'http://blog.dev').'/register/verify/'. $token; 
            Mail::send('auth.confirmEmail', ['url' => $url], function ($message) use ($email)
            {
                $message->from('anisndeyan92@gmail.com', 'Laravel');
                $message->to($email);
                $message->subject('Please confirm your verification!!!');
            });
            return view('home');
        } 
        else {
            return redirect('home');
        }
    }

    protected function verify($token)
    {
        if (Auth::user() && Auth::user()->token == $token) {
            Auth::user()->confirm = 1;
            Auth::user()->save();
            return redirect('home');
        } else {
            return redirect('/login');
        }
    }
}
