<?php

namespace CMV\Http\Middleware;

use Closure;
use Auth;

class IsSalesRep
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


        if(!hasRole('sales-rep'))
        {
            \Flash::error('You need to be a sales rep to view that page.');

            return redirect()->to('/home');
        }
        
        return $next($request);
    }
}
