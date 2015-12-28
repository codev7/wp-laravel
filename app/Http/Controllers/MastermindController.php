<?php

namespace CMV\Http\Controllers;

use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

/**
 * @Controller(prefix="mastermind")
 * @Middleware("mastermind")
 */
class MastermindController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     * @Get("dashboard", as="mastermind.dashboard")
     * @return Response
     */
    public function dashboard()
    {   

        $projects = \CMV\Models\PM\Project::orderBy('created_at', 'desc')->paginate(25);

        return view('mastermind/dashboard')->with([
            'projects' => $projects
        ]);
    }

}
