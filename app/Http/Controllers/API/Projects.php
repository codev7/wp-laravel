<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Project, CMV\Models\PM\Team, CMV\Models\PM\User;
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

        $projectName = $data['project_name'];


        $user = User::create(['email' => $data['email']]);

        $user->name = $data['name'];
        $user->password = isset($data['password']) ? bcrypt($data['password']) : bcrypt(date('Y-m-d'));

        $team = Team::create(['name' => $data['company_name']]);

        $user->joinTeamById($team->id);
        $user->save();

        $team->owner()->associate($user);
        $team->save();

        Event::fire('user.registered', $user);

        $projectData = [
            'name' => $projectName,
            'requested_deadline' => $data['requested_deadline'],
        ];

        $project = Project::create($projectData);

        $project->slug = str_replace(' ','-',strtolower($projectName));
        $project->team()->associate($team);

        $project->save();

        $project->createOrFindProjectTypeId($data['project_type']);

        Auth::login($user);

        $user->switchToTeam($team);

        $user->save();

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

        $project = Project::create([
            'name' => $data['project_name'],
            'requested_deadline' => $data['requested_deadline'],
        ]);

        $project->team()->associate(Auth::user()->currentTeam());

        $project->save();

        $project->createOrFindProjectTypeId($data['project_type']);

        return $this->show($project->id);
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
}