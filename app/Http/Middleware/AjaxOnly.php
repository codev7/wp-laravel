<?php

namespace CMV\Http\Middleware;

use Closure;

class AjaxOnly
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
        if(!$request->ajax() && !$request->header('X-CSRF-TOKEN') != '')
        {
            return redirect()->to('/');
        }
        
        return $next($request);
    }
}
