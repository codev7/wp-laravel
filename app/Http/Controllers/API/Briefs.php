<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Project;
use CMV\Models\PM\ProjectBrief;
use CMV\Services\BriefsService;
use Input, Auth, Validator;

/**
 * Methods for system-wide brief managing. Is usable only by admin.
 * For non-admin users see ProjectBriefs.php
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
     * @Get("api/briefs")
     */
    public function index()
    {
        $paginator = $this->service->all()->paginate();

        return $this->respondWithPaginatedData($paginator);
    }

    /**
     * @Get("api/briefs/{briefs}")
     * @param $id
     */
    public function show($id)
    {
        $brief = $this->service->find($id);

        return $this->respondWithData($brief);
    }

    /**
     * @Post("api/briefs")
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