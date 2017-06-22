<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleCallback');

Route::get('/register/verify', 'Auth\RegisterController@verification');
Route::get('/register/verify/{token}', 'Auth\RegisterController@verify');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/category/{id}/posts', 'PostController@categoryPosts');
Route::get('/category/myCategories', 'CategoryController@showMyCategories');

Route::resource('/category', 'CategoryController');
Route::resource('/post', 'PostController');




