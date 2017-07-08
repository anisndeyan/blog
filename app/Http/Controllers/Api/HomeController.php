<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use App\Post;
use Auth;

class HomeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       	$userCount= User::count();   
       	$categoryCount= Category::count();
       	$postCount= Post::count();
       	return response()->json(['userCount'=> $userCount, 'categoryCount'=> $categoryCount,
       	 'postCount'=> $postCount]);  
    }
};
