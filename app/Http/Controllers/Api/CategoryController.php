<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Category;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
	public function __construct(Category $category)
    {
        parent::__construct();
        $this->middleware('auth');
        $this->category = $category;
    }
    public function create(CategoryRequest $request)
    {
        $inputs = [
            'name'      => $request->get('name'),
            'user_id'   => Auth::id()
        ];
        if ($this->category->create($inputs)) {
            return response()->json(['success' => 'Category has been successfully created']);
        }
        return response()->json(['error' => 'Something went wrong!!!']);
    }

    public function myCategories(){

        $id         = Auth::id();
        $categories = $this->category->where('user_id', $id)->get();

        return response()->json(['categories' => $categories]);
    }

    public function allCategories()
    {

        $category   = $this->category->get();
        return response()->json(['categories' => $category]);
    }

     
    public function edit($id)
    {
        $category = $this->category->find($id);
       return response()->json(['categories' => $category]);
    }
}
