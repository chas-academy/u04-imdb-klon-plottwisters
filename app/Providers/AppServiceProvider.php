<?php

namespace App\Providers;


use Illuminate\Routing\UrlGenerator as RoutingUrlGenerator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }

    protected $policies = [
    Watchlist::class => WatchlistPolicy::class,
    ];


    /**
     * Bootstrap any application services.
     */
    public function boot(RoutingUrlGenerator $url): void
    {
        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
    }
}
