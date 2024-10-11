<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 全てのビューにユーザー情報とカテゴリーを渡す
        View::composer('*', function ($view) {
            if (\Auth::check()) {
                $user = \Auth::user();
                $categories = $user->categories;  // ユーザーのカテゴリー
                $view->with('user', $user)->with('usercategories', $categories);
            }
        });
         \URL::forceScheme('https');
         $this->app['request']->server->set('HTTPS','on');
         Paginator::useBootstrap();
    }
    
}
