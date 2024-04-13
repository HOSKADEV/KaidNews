<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('days', Setting::where('name','days')->first()->value);
            $view->with('groups', Setting::where('name','groups')->first()->value);
            $view->with('start_date', Setting::where('name','start_date')->first()->value);
            $view->with('promotion', Setting::where('name','promotion')->first()->value);
            $view->with('specialization', Setting::where('name','specialization')->first()->value);
            $view->with('branch', Setting::where('name','branch')->first()->value);

            
        });
    }
}
