<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Project;
use CMV\Models\PM\ProjectBrief;
use CMV\Services\BriefsService;
use Input, Auth, Validator;

/**
 * Methods for system-wide brief managing. Is usable only by admin.
 * For non-admin users see ProjectBriefs.php
 * @package CMV\Http\Controllers\API
 */
class Briefs extends Controller {

    protected $service;

    public function __construct()
    {
        $project = Project::find(\Request::route('projects'));
        $this->service = new BriefsService(Auth::user(), $project);
    }

    /**
     * @Get("api/projects/{projects}/briefs")
     */
    public function index($projectId)
    {
        $paginator = $this->service->all()->paginate();

        return $this->respondWithPaginatedData($paginator);
    }

    /**
     * @Get("api/projects/{projects}/briefs/templates")
     */
    public function templates()
    {
        return $this->respondWithData(BriefsService::templates());
    }


    /**
     * @Get("api/projects/{projects}/briefs/{briefs}")
     * @param $projectId
     * @param $briefId
     */
    public function show($projectId, $briefId)
    {
        $brief = $this->service->find($briefId);

        return $this->respondWithData($brief);
    }

    /**
     * @Post("api/projects/{projects}/briefs")
     */
    public function create()
    {
        $data = Input::all();
        $validator = Validator::make($data, [
            'text' => 'required',
            'project_id' => 'required|exists:projects,id'
        ]);

        if ($validator->fails) {
            return $this->respondWithFailedValidator($validator);
        }

        $project = Project::find($data['project_id']);
        $brief = $this->service->create($project, $data);

        return $this->respondWithData($brief);
    }

    /**
     * @Put("api/briefs")
     */
    public function update()
    {
        //..
    }

}