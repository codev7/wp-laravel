<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Project, CMV\Team, CMV\User;
use CMV\Services\MessagesService;
use Input, Validator, Auth, Event;

class Projects extends Controller {

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
        $data['name'] = $data['project_name'];
        $project = Project::create(array_only($data, ['name', 'requested_deadline']));
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