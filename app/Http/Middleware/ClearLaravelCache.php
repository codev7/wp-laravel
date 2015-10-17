<?php

namespace CMV\Http\Middleware;

use Closure;

class ClearLaravelCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('APP_ENV') === 'local' && env('CLEAR_VIEW_CACHE') === true) {
            $cachedViewsDirectory=app('path.storage').'/framework/views/';
            $files = glob($cachedViewsDirectory.'*');
            foreach($files as $file) {
                if(is_file($file)) {
                    @unlink($file);
                }
            }
        }

        return $next($request);
    }
}
