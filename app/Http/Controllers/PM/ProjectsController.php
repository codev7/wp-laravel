<?php

namespace CMV\Http\Controllers\PM;

use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     * @Get("home", as="app.home")
     * @return Response
     */
    public function home()
    {

        return view('projects/home');

    }

    /**
     * Store a newly created resource in storage.
     * @Get("project/new", as="project.new")
     * @return Response
     */
    public function newProject()
    {
        return view('projects/new');
    }
}
