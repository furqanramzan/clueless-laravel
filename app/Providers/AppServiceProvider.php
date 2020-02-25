<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \View::composer(['guest.layouts.header'], function($view){
            $toplists = \App\Models\TopList::orderBy('order', 'desc')->select('id', 'name')->get();
            $view->with(['toplists' => $toplists]);
        });
    }
}
