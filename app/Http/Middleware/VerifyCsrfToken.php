<?php

namespace CMV\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Closure;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'prospector/webhook/*',
        'stripe/webhook',
        'webhooks/*',
        'blog',
        'blog/*',
        '/',
    ];

    public function handle($request, Closure $next)
    {
        if (env('APP_ENV') == 'testing') {
            return $next($request);
        }

        return parent::handle($request, $next);
    }

}
