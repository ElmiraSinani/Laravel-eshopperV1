<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        Schema::defaultStringLength(191);

        View::share('Name', 'John'); // inside any view we can call {{ $Name }} and output will be 'John'
        
        //other way to share data with view, usage inside view blade {{ $userData->name }}
        View::composer('*', function($view){ //use home, dashboard etc instead of * to show data in specific view
            $view->with('userData', Auth::user());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
