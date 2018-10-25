<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if("client",function () {
            return auth()->check() && ( \App\User::hasRole1(3));
        });
        
        Blade::if("trader",function () {
            return auth()->check() && (\App\User::hasRole1(2));
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
