<?php

namespace CMV\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \CMV\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \CMV\Http\Middleware\VerifyCsrfToken::class,
        \CMV\Http\Middleware\ClearLaravelCache::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \CMV\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \CMV\Http\Middleware\RedirectIfAuthenticated::class,
        'admin_auth' => \CMV\Http\Middleware\IsAdministrator::class,
        'sales-rep' => \CMV\Http\Middleware\IsSalesRep::class,
        'ajax' => \CMV\Http\Middleware\AjaxOnly::class,
    ];
}
