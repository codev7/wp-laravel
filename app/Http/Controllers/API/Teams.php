<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Project, CMV\Team, CMV\User;
use CMV\Services\ProjectsService;
use Input, Validator, Auth, Event;

class Teams extends Controller {

    protected $projectsService;

    public function __construct()
    {
        $this->projectsService = new ProjectsService(Auth::user());
    }

}