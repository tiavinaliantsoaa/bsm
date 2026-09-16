<?php

namespace App\Providers;

use App\Data\SiteData;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        $this->forceHttpsWhenConfigured();
        $this->configureRateLimiting();

        // Expose company data + navigation to every view without repeating in controllers.
        View::composer('*', function ($view) {
            $view->with('company', SiteData::company())
                ->with('navigation', SiteData::navigation());
        });
    }

    private function forceHttpsWhenConfigured(): void
    {
        $appUrl = (string) config('app.url');

        if ($this->app->environment('production') || str_starts_with($appUrl, 'https://')) {
            URL::forceHttps();
        }
    }

    private function configureRateLimiting(): void
    {
        RateLimiter::for('contact', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });
    }
}
