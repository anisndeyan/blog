<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Category;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

	public function __construct(Post $post, Category $category)
    {
        parent::__construct();
        $this->middleware('auth');
        $this->post = $post;
        $this->category = $category;
    }

    public function create(Request $request, Guard $auth, User $user)
    {
        $image_name = null;
        $category = Category::all();
        if ($request->hasFile('image')) {            
            $user_image = $request->file('image');
            $image_name = time().$user_image->getClientOriginalName();
            $user_image->move(public_path().'/images/', $image_name);
        }
        $inputs = $request->only('title', 'text', 'category_id');
        $inputs['image'] = $image_name;
        
        if ($this->post->create($inputs)) {
            $user_id    = $auth->id();
            $posts      = $auth->user()->posts;
            $user       = $user->where('id', $user_id)->first();
            $posts      = $user->posts;
            return response()->json(['message' => 'Post has been successfully created']);

        }   
    }
    public function cat(Guard $auth){
     
       $categories = $this->category->where('user_id', $auth->id())->get();
       return response()->json(['categories' => $categories]);
        
    }
    public function myPosts (Guard $auth)
    {   
        $posts  = $auth->user()->posts()->get();
        return response()->json(['posts' => $posts]);
    }

    public function allPosts()
    {
        $posts = $this->post->get();
        return response()->json(['posts' => $posts]);
    }

    public function edit ($id, Post $post, Guard $auth)
    {
        $categories = $this->category->where('user_id', $auth->id())->get();
        $post       = $this->post->find($id);
        return response()->json(['posts' => $post, 'categories' => $categories ]);
    }

    public function update($id, PostRequest $request)
    {
        $image_name = null;

        if ($request->hasFile('image')) {
            $user_image = $request->file('image');
            $image_name = time().str_random().$user_image->getClientOriginalName();
            $user_image->move(public_path().'/images/', $image_name);
        }
        $inputs = $request->only('title', 'text', 'category_id');
        $inputs['image'] = $image_name;

        if($this->post->where('id', $id)->update($inputs)){

            return response()->json(['message'=>"Post has successfully updated!!!"]);
        };
    }

    public function delete($id)
    {
        $this->post->where('id', $id)->delete();
        $posts = $this->post->get();
        return response()->json(['message' => "Post has been successfully deleted!!!"]);
        
    }  
}
