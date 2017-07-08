<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::get('logout', 'AuthController@logout');
Route::get('home', 'HomeController@index');

Route::post('category/create', 'CategoryController@create');
Route::get('category/index', 'CategoryController@myCategories');
Route::get('category/all', 'CategoryController@allCategories');
Route::get('category/{id}/edit', 'CategoryController@edit');
Route::put('category/{id}', 'CategoryController@update');
Route::delete('category/{id}', 'CategoryController@delete');

// Route::post('post/create', 'PostController@create');
// Route::get('post/index', 'PostController@myPosts');
// Route::get('post/all', 'PostController@allPosts');
// Route::get('post/{id}/edit', 'PostController@edit');
// Route::post('post/{id}/update', 'PostController@update');
// Route::delete('post/{id}', 'PostController@delete');

// Route::get('/category/{id}/post', 'CategoryController@categoryPost');


