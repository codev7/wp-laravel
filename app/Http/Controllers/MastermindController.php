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
        return view('mastermind/dashboard');
    }

}
