<?php

namespace CMV\Http\Middleware;

use Closure;
use Auth;
use Flash;

class IsAdministrator
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
        $user = Auth::user();

        if ($user->isAdministrator() === false)
        {
            Flash::error('You need to be an admin to view that page.');

            \Session::reflash();

            return redirect()->guest('/');
        }

        return $next($request);
    }
}
