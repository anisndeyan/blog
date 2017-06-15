<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use App\Category;
use App\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer ('layouts.leftSideBar', function($view){
            $countUsers = User::all()->count();
            $countCategories = Category::all()->count();
            $countPosts = Post::all()->count();
            $view->with (compact ('countUsers', 'countCategories', 'countPosts'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
