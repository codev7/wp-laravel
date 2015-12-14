<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Project;
use CMV\Models\PM\ProjectBrief;
use CMV\Services\BriefsService;
use CMV\Services\MessagesService;
use Input, Auth, Validator;

/**
 * @package CMV\Http\Controllers\API
 */
class Briefs extends Controller {

    /**
     * @var BriefsService
     */
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
        $briefs = $this->service->all()->with('createdByUser', 'approvedByUser')->get();

        return $this->respondWithData($briefs->toArray());
    }

    /**
     * @Get("api/projects/{projects}/briefs/{briefs}")
     * @param $projectId
     * @param $briefId
     */
    public function show($projectId, $briefId)
    {
        $brief = $this->service->find($briefId);
        $brief->load('project');

        return $this->respondWithData($brief->toArray());
    }

    /**
     * @Post("api/projects/{projects}/briefs")
     */
    public function create($projectId)
    {
        $data = Input::all();
        $validator = Validator::make($data, [
            'brief' => 'required|array',
            'brief.brief_type' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $project = Project::find($projectId);
        $brief = $this->service->create($data);
        $brief->load('project');

        return $this->respondWithData($brief->toArray());
    }

    /**
     * @Put("api/projects/{projects}/briefs/{briefs}")
     * @param $projectId
     * @param $briefId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($projectId, $briefId)
    {
        $data = Input::all();
        $validator = Validator::make($data, [
            'brief' => 'required|array',
            'brief.brief_type' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $brief = $this->service->find($briefId);
        $this->service->update($brief, $data);
        $brief->load('project');

        return $this->respondWithData($brief->toArray());
    }

    /**
     * @Post("api/projects/{projects}/briefs/{briefs}/send-to-client")
     * @param $projectId
     * @param $briefId
     * @return mixed
     */
    public function sendToClient($projectId, $briefId)
    {
        $brief = $this->service->find($briefId);
        $this->service->sendToClient($brief);

        return $this->respondWithData($brief->toArray());
    }

    /**
     * @Post("api/projects/{projects}/briefs/{briefs}/request-changes")
     */
    public function requestChanges($projectId, $briefId)
    {
        $data = Input::all();
        $validator = Validator::make($data, [
            'text' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $messageService = new MessagesService(Auth::user());
        $project = Project::find($projectId);
        $messageService->postInNewThread($project, $data['text']);

        return $this->respondWithSuccess();
    }

    /**
     * @Post("api/projects/{projects}/briefs/{briefs}/approve")
     * @param $projectId
     * @param $briefId
     * @return mixed
     */
    public function approveBrief($projectId, $briefId)
    {
        $brief = $this->service->find($briefId);
        $this->service->approve($brief);

        return $this->respondWithData($brief->toArray());
    }

}