<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use Auth;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    public function __construct(Category $category)
    {
        parent::__construct();
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->get();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('categories.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $inputs = [
            'name'  => $request->get('name'),
            'user_id' => Auth::id()
            ];

        if($this->category->create($inputs)){
            return redirect()->back()->with('success', 'Category has been successfully created!!!');
        }
        
        return redirect()->back()->with('error', 'Something went wrong!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->category->where('id', $id)->first();
        return view('categories.show', ['categories' => $category]);
    }

    public function showMyCategories(){
        $id = Auth::id();
        $categories = $this->category->where('user_id', $id)->get();
        return view('categories.myCategories', ['categories' => $categories]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->category->find($id);
        return view("categories.edit", ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if($this->category->where('id', $id)->update(['name' => $request->get('name')])){
            return redirect()->back()->with(['success' => "Category has been successfully updated!!!"]);
        } else{
            return redirect()->back()->with(['error' => "Something went wrong!!!"]);
        }
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category->where('id', $id)->delete();
        $categories = $this->category->get();
        return redirect()->back()->with( ['categories' => $categories]);
    }  

}
