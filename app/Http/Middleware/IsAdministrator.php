<?php

namespace CMV\Http\Middleware;

use Closure;
use Auth;
use Flash;

class IsAdministrator extends Middleware
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

        if ($user && ($user->isAdministrator() || $user->isMastermind()))
        {
            return $next($request);
        }

        return $this->respondWithError('You need to be an admin to view that page.');
    }
}
