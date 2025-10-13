<?php

namespace App\Providers;

use App\Support\QRCode;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind the key 'QRCode' to the QRCode class
        $this->app->singleton('QRCode', fn() => new QRCode());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
