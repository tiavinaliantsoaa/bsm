<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Read from the process environment, not config(): this callback also
        // runs while resolving the console kernel (package:discover), before
        // the config repository exists. After config:cache, set TRUSTED_PROXIES
        // in the host environment (OVH panel) if a reverse proxy must be trusted.
        $proxies = $_ENV['TRUSTED_PROXIES'] ?? $_SERVER['TRUSTED_PROXIES'] ?? '';
        if (! is_string($proxies) || $proxies === '') {
            return;
        }

        $at = $proxies === '*'
            ? '*'
            : array_values(array_filter(array_map('trim', explode(',', $proxies))));

        if ($at === '*' || $at !== []) {
            $middleware->trustProxies(
                at: $at,
                headers: Request::HEADER_X_FORWARDED_FOR
                    | Request::HEADER_X_FORWARDED_HOST
                    | Request::HEADER_X_FORWARDED_PORT
                    | Request::HEADER_X_FORWARDED_PROTO
            );
        }
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
