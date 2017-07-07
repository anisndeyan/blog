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
Route::get('/home', 'HomeController@index');

Route::post('category/create', 'CategoryController@create');
Route::get('category/index', 'CategoryController@index');
Route::get('category/show', 'CategoryController@show');
Route::get('category/{id}/edit', 'CategoryController@edit');
Route::put('category/{id}/update', 'CategoryController@update');
Route::delete('category/{id}', 'CategoryController@delete');

Route::post('post/create', 'PostController@create');
Route::get('post/index', 'PostController@index');
Route::get('post/show', 'PostController@show');
Route::get('post/{id}/edit', 'PostController@edit');
Route::post('post/{id}/update', 'PostController@update');
Route::delete('post/{id}', 'PostController@delete');

Route::get('/category/{id}/post', 'CategoryController@categoryPost');


