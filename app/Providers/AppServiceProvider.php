<?php

namespace App\Providers;

use Schema;
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
        Schema::defaultStringLength(191);
        
        \View::composer(['guest.layouts.header'], function($view){
            $toplists = \App\Models\TopList::orderBy('order', 'desc')->select('id', 'name')->get();
            $view->with(['toplists' => $toplists]);
        });

        \View::composer(['admin.layout.sidebar'], function($view){
            $contact = \App\Models\Setting::where('key', 'contact_us')->select('id')->first();
            $footer = \App\Models\Setting::where('key', 'footer')->select('id')->first();
            $view->with(['contact' => $contact, 'footer' => $footer]);
        });
    }
}
