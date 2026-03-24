<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
    // public function boot(): void
    // {
    //     // Force all URLs to use the ngrok domain
    //     if (env('NGROK_URL')) {
    //         URL::forceRootUrl(env('NGROK_URL'));

    //          //لو تستخدم https مع ngrok
    //         URL::forceScheme(parse_url(env('NGROK_URL'), PHP_URL_SCHEME));
    //     }
    // }
}