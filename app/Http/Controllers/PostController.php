<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{   
    public function __construct(Post $post, Category $category)
    {
        parent::__construct();
        $this->middleware('auth');
        $this->post = $post;
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->get();
        return view("posts.allPosts", ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Guard $auth)
    {
        $categories = $this->category->where('user_id', $auth->id())->get();
        return view("posts.addPosts", ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Guard $auth, User $user)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $userImage  = $request->file('image');
            $imageName  = time()->$userImage->getClientOriginalName();
            $userImage->move(public_path().'/images/', $imageName);
        }

        $inputs = [
            'title'         => $request->get('title'),
            'text'          => $request->get('text'),
            'category_id'   => $request->get('category'),
            'image'         => $imageName,
        ];
        if ($this->post->create($inputs)) {
            $user_id    = $auth->id();
            $posts      = $auth->user()->posts;
            $user       = $user->where('id', $user_id)->first();
            $posts      = $user->posts;
            return view("posts.myPosts", ['posts' => $posts]); 
        } else {
            return redirect()->back()->with(['error' => "Something went wrong!!!"]);
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id, Guard $auth)
    {
        $posts  = $auth->user()->posts;
        return view("posts.myPosts", ['posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function edit (Post $post, Guard $auth)
    {
        $categories = $this->category->where('user_id', $auth->id())->get();
        //dd($post);
        //$post       = $this->post->find($id);
        return view('posts.editPost', ['post' => $post, 'categories' => $categories]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function update(PostRequest $request, Post $post)
    {
        $input = '';
        //dd($reques);
        if ($request->hasFile('image')) {
            $userImage = $request->file('image');
            $imageName = $userImage->getClientOriginalName();
            $userImage->move(public_path().'/images/', $imageName);
            $input = [
                'title'         => $request->get('title'),
                'text'          => $request->get('text'),
                'image'         => $imageName,
                'category_id'   => $request->get('category'),
            ];
        } else {
            $input = [
                'title'         => $request->get('title'),
                'text'          => $request->get('text'),
                'category_id'   => $request->get('category'),
            ];
        }    
        if ($post->update($input)) {
            return redirect()->back()->with(['success' => "Post has successfully updated!!!"]);
        } else {
            return redirect()->back()->with(['error' => "Something went wrong!!!"]);
        }
    }

    public function categoryPosts($id)
    {
        $category   = $this->category->find($id);
        $posts      = $this->post->where('category_id', $id)->get();
        return view("posts.postsCat", ['posts' => $posts, 'category' => $category->name]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->post->where('id', $id)->delete();
        $posts = $this->post->get();
        return redirect()->back()->with( ['posts' => $posts]);
        
    }

}
