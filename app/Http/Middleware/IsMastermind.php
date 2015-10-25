<?php

namespace CMV\Http\Middleware;

use Closure;
use Auth;

class IsMastermind
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
        if(!Auth::check())
        {
            \Flash::error('You need to login first.');
            return redirect()->guest('/login');
        }


        if(!hasRole('mastermind'))
        {
            \Flash::error('You need to be a mastermind to view that page.');

            return redirect()->to('/home');
        }
        
        return $next($request);
    }
}
