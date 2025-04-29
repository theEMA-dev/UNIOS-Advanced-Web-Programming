<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app['router']->aliasMiddleware('setlocale', \App\Http\Middleware\SetLocale::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app['router']->pushMiddlewareToGroup('web', \App\Http\Middleware\SetLocale::class);
    }
}
