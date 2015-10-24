<?php

namespace CMV\Http\Controllers\PM;

use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

/**
 * @Controller(prefix="concierge")
 */
class ConciergeController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     * @Get("home", as="concierge.home")
     * @return Response
     */
    public function home()
    {

        return view('concierge/home');

    }
}
