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
        $this->middleware('guest')->except('logout');;
    }

	public function register(Request $request)
	{
		$this->validate($request, [
            'name'  	=> 'required|max:255',
            'email' 	=> 'required|email|max:255|unique:users',
            'password' 	=> 'required|min:6|confirmed',
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


	public function login (Request  $request){
		dd($request);
		return response()->json(['login'=> $request->all()]);
	}


	public function logout ()
    {
        Auth::logout();
        return response()->json(['msg'=>"logout"]);
    }
}