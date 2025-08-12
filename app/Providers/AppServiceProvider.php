<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TrackLastLogin;

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
        // Register custom middleware
    $router = $this->app['router'];
    $router->aliasMiddleware('admin', AdminMiddleware::class);
    $router->aliasMiddleware('track.login', TrackLastLogin::class);
    
    // Set global middleware for tracking logins
    $this->app['router']->pushMiddlewareToGroup('web', TrackLastLogin::class);
    }
}
