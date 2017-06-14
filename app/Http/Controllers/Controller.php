<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use App\Category;
use App\Post;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
    	$this->countUsers = User::all()->count();
    	$this->countCategories = Category::all()->count();
    	$this->countPosts = Post::all()->count();
    	View::share(['countUsers' => $this->countUsers, 'countCategories' => $this->countCategories, 'countPosts' => $this->countPosts]);
    }

}
