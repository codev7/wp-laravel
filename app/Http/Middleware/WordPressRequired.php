<?php

namespace CMV\Http\Middleware;

use Closure;

class WordPressRequired
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
        if(env('ENABLE_WP') !== true)
        {
            dd('You need to define ENABLE_WP=true in your .env file.');
        }
        
        return $next($request);
    }
}
