<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ensure generated asset/route URLs stay HTTPS behind reverse proxies (Render).
        if (
            app()->environment('production')
            || request()->isSecure()
            || request()->header('x-forwarded-proto') === 'https'
        ) {
            URL::forceScheme('https');
        }
        
        Paginator::useBootstrap();
    }
}
