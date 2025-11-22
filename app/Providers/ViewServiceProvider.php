<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Truyền biến $user đến tất cả view 'layouts.header'
        View::composer('_layouts.header', function ($view) {
            $view->with('user', Auth::guard('user')->user());
        });
    }
}
