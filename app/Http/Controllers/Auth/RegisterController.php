<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/registration/verification';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => md5(time())
        ]);
    }


    protected function verification()
    {

        if (Auth::user()->confirm == 0) {
            $token = Auth::user()->token;
            $url = env('APP_URL', 'http://blog.dev').'/registration/verification/'. $token; 
            $email = Auth::user()->email;
            Mail::send('auth.confirmEmail', ['url' => $url], function ($message) use ($email)
            {
                $message->from('anisndeyan92@gmail.com', 'Laravel');
                $message->to($email);
                $message->subject('Please confirm your verification!!!');
            });
            return view('auth.verifycation');
        } else {
            return redirect('home');
        }
    }

    protected function verify($token)
    {
        $user = Auth::user();
        if ($user && $user->token == $token) {
            $user->confirm = 1;
            $user->save();
            return redirect('home');
        } else {
            return redirect('/login');
        }
    }
}
