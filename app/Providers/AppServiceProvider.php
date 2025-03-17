<?php

namespace App\Providers;

use App\Models\Config;
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
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $config = Config::first();
            $view->with('config', $config);
        });
        if (env('APP_ENV') === 'production') { // Pastikan hanya dijalankan pada produksi
            URL::forceScheme('https');
        }
    }
}
