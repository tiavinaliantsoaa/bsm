<?php

namespace App\Providers;

use App\Data\SiteData;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            $forwarded = strtolower((string) request()->header('X-Forwarded-Proto', ''));
            $scheme = trim(explode(',', $forwarded)[0]);

            if ($scheme === 'https' || request()->secure()) {
                URL::forceHttps();
            }
        }

        // Expose company data + navigation to every view without repeating in controllers.
        View::composer('*', function ($view) {
            $view->with('company', SiteData::company())
                 ->with('navigation', SiteData::navigation());
        });
    }
}
