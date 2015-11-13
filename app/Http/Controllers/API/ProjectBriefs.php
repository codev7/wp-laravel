<?php
namespace CMV\Http\Controllers\API;

use Auth, Input, Validator;
use CMV\Models\PM\Project;
use CMV\Services\BriefsService;

/**
 * Methods for briefs managing. Is used by non-admin users.
 * @Middleware("auth.admin")
 * @package CMV\Http\Controllers\API
 */
class Briefs extends Controller {

    protected $service;

    public function __construct()
    {
        $this->service = new BriefsService(Auth::user());
    }

    /**
     * @Get("api/projects/{projects}/briefs")
     */
    public function index($id)
    {
        $project = Project::find($id);
        $briefs = $this->service->all($project)->get();

        return $this->respondWithData($briefs->toArray());
    }

    /**
     * @Get("api/projects/{projects}/briefs/{briefs}")
     * @param $projectId
     * @param $briefId
     * @return
     * @internal param $id
     */
    public function show($projectId, $briefId)
    {
        $brief = $this->service->find($briefId);

        return $this->respondWithData($brief);
    }

    /**
     * @Post("api/projects/{projects}/briefs/{briefs}/approve")
     */
    public function approve($projectId, $briefId)
    {
        $brief = $this->service->find($briefId);
        $this->service->approve($brief);

        return $this->respondWithSuccess();
    }
}