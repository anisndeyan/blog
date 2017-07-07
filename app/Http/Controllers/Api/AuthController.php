<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

	public function register(Request $request)
	{
		$this->validate($request, [
            'name'  	=> 'required|max:255',
            'email' 	=> 'required|email|unique:users',
            'password' 	=> 'required|min:4|confirmed',
        ]);

        $user = User::create([
            'name'   	=> $request->input('name'),
            'email' 	=> $request->input('email'),
            'confirm' 	=> 1,
            'password' 	=> bcrypt($request->input('password')),
            'token' 	=> md5(time()),
        ]);
		
		return response()->json(['data'=> $request->all()]);
	}

	public function login (Request $request, User $user)
	{
		$this->validate($request, [
            'email'    	=> 'required|email',
            'password' 	=> 'required',
        ]);
        
        $result = ['email' => $request->input('email'), 'password' => $request->input('password')];
            if(!Auth::attempt($result, $request->has('remember'))){
                return response()->json(['message'=>"Wrong username or password"]);
            }
            $user = $user->where('email', $request->input('email'))->first();
            Auth::login($user);
            return response()->json(['data'=>Auth::user()]);
	}

	public function logout ()
    {
        Auth::logout();
        return response()->json(['msg'=>"logout"]);
    }
}