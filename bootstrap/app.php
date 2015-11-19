<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    CMV\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    CMV\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    CMV\Exceptions\Handler::class
);

$app->bind('Bitbucket', function() {
    // @example http://gentlero.bitbucket.org/bitbucket-api/examples/
    // @see: https://bitbucket.org/account/user/<username or team>/api
    $oauth_params = [
        'oauth_consumer_key'         => Config::get('services.bitbucket.key'),
        'oauth_consumer_secret'     => Config::get('services.bitbucket.secret'),
    ];

    $bitbucket = new \Bitbucket\API\Api();
    $bitbucket->getClient()->addListener(
        new \Bitbucket\API\Http\Listener\OAuthListener($oauth_params)
    );

    return $bitbucket;
});

$app->bind('access', function() {
    return new \CMV\Misc\ACL(Auth::user());
});

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
