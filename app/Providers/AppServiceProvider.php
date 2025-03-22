
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
        
        // Force HTTPS in production
        if (env('APP_ENV') === 'production' || env('FORCE_HTTPS') === 'true') {
            URL::forceScheme('https');
        }
    }
}
