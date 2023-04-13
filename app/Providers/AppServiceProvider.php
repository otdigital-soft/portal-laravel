<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\SidebarComposer;
use App\Http\View\Composers\NavigationComposer;
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
        View::composer('partials.main.sidenav', SidebarComposer::class);
        View::composer('partials.main.navigation', NavigationComposer::class);
        View::composer('partials.master.navigation', NavigationComposer::class);
        View::composer('project', NavigationComposer::class);
        View::composer('home', NavigationComposer::class);
    }
}
