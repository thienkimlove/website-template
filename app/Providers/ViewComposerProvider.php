<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

      /*  view()->composer('frontend', function ($view) {
            $view->with('links',  Cache::remember('composer_links', 10, function() {
                return DB::table('links')->get();
            }));
        });*/

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
