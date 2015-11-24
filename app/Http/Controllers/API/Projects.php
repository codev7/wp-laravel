<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Project, CMV\Team, CMV\User;
use CMV\Services\MessagesService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Input, Validator, Auth, Event;

class Projects extends Controller {

    use DispatchesJobs;

    /**
     * @Middleware("auth")
     * @Get("api/projects")
     */
    public function index()
    {
        $projects = Auth::user()->currentTeam->projects;

        return $this->respondWithData($projects->toArray());
    }

    /**
     * @Post("api/projects/create_and_register")
     */
    public function createAndRegister()
    {
        $data = Input::all();

        $validator = Validator::make($data, [
            'email' => 'required|unique:users,email',
            'user_name' => 'required',
            'company_name' => 'required',
            'project_name' => 'required',
            'project_type' => 'required',
            'requested_deadline' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $user = User::create(['email' => $data['email']]);

        $user->name = $data['user_name'];
        $user->password = isset($data['password']) ? bcrypt($data['password']) : bcrypt(date('Y-m-d'));

        $team = Team::create(['name' => $data['company_name']]);

        $user->joinTeamById($team->id);
        $user->save();

        $team->owner()->associate($user);
        $team->save();

        $user->switchToTeam($team);
        $user->save();

        Event::fire('user.registered', $user);
        Auth::login($user);

        $project = $this->createProject($team, $data);


        return $this->show($project->id);
    }

    /**
     * @Middleware("auth")
     * @Post("api/projects")
     */
    public function create()
    {
        $data = Input::all();

        $validator = Validator::make($data, [
            'project_name' => 'required',
            'project_type' => 'required',
            'requested_deadline' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $project = $this->createProject(Auth::user()->currentTeam(), $data);

        return $this->show($project->id);
    }

    /**
     * @param Team $team
     * @param array $data - ['project_name', 'project_type', 'requested_deadline', 'message'[, 'agreed_to_nda'] ]
     * @return Project
     */
    protected function createProject(Team $team, array $data)
    {
        $attrs = [
            'name' => $data['project_name'],
            'requested_deadline' => $data['requested_deadline']
        ];
        $attrs['status'] = Project::STATUS_QUOTE;
        $attrs['project_manager_id'] = env('DEFAULT_PM_USER_ID');

        $project = Project::create($attrs);
        $project->team()->associate($team);
        $project->save();
        $project->createOrFindProjectTypeId($data['project_type']);

        $this->postMessageToProject($project, $data['message']);

        if (isset($data['agreed_to_nda']) && $data['agreed_to_nda']) {
            $team->agreeToNDA();
        }

        return $project;
    }

    /**
     * @Middleware("admin_auth")
     * @Put("api/projects/{projects}")
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $data = Input::all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'developer_id' => 'exists:users,id',
            'project_manager_id' => 'required|exists:users,id',
            'project_type_id' => 'required|exists:project_types,id',
            'status' => 'required|in:'.implode(',', Project::$statuses)
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $project = Project::find($id);
        $project->name = $data['name'];
        $project->developer_id = $data['developer_id'];
        $project->project_manager_id = $data['project_manager_id'];
        $project->project_type_id = $data['project_type_id'];
        $project->status = $data['status'];
        $project->save();

        return $this->show($project->id);
    }

    /**
     * @Middleware("admin_auth")
     * @Post("api/projects/{projects}/create_bb_repository")
     * @return mixed
     */
    public function createBBRepository($id)
    {
        // check if already has repo
        /** @var Project $project */
        $project = Project::find($id);
        if ($project->hasRepo()) {
            return $this->respondWithError('Project already has associated repository');
        }

        // $this->dispatch(new ..)

        return $this->respondWithSuccess();
    }

    /**
     * @Middleware("admin_auth")
     * @Post("api/projects/{projects}/resend_invoice")
     * @param $id
     * @return mixed
     */
    public function resendInvoice($id)
    {
        $project = Project::find($id);

        // $this->dispatch(new ..)

        return $this->respondWithSuccess();
    }

    /**
     * @Middleware("admin_auth")
     * @Post("api/projects/{projects}/create_staging_site")
     * @param $id
     * @return mixed
     */
    public function createStagingSite($id)
    {
        $project = Project::find($id);

        // $this->dispatch(new ..)

        return $this->respondWithSuccess();
    }

    /**
     * @Middleware("param-access")
     * @Get("api/projects/{projects}")
     * @param $id
     */
    public function show($id)
    {
        $project = Project::find($id);

        return $this->respondWithData($project->toArray());
    }

    /**
     * @param Project $project
     * @param $message
     * @return \CMV\Models\PM\Message
     */
    protected function postMessageToProject(Project $project, $message)
    {
        $messageService = new MessagesService(Auth::user());
        return $messageService->postInNewThread($project, $message);
    }
}