<?php

namespace CMV\Http\Middleware;

use Closure;
use Auth;

class MustHaveTeam
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
        if(Auth::check() && ! Auth::user()->hasTeams() && ! $request->is('settings') && ! $request->ajax())
        {   
            \Flash::error('You must have a team.  Please create a team.');
            return redirect()->to('/settings?tab=teams');
        }

        return $next($request);
    }
}
