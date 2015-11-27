<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Project, CMV\Team, CMV\User;
use CMV\Services\TeamsService;
use Input, Validator, Auth, Event;

class Teams extends Controller {

    protected $teamsService;

    public function __construct()
    {
        $this->teamsService = new TeamsService(Auth::user());
    }

    /**
     * @Get("api/teams/{teams}/users_access")
     * @param $id
     */
    public function users($id)
    {
        $team = \Auth::user()->teams()->findOrFail($id);

        return $this->respondWithData($this->teamsService->users($team));
    }
}