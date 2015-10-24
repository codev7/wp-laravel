<?php

namespace CMV\Http\Controllers\PM;

use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

use CMV\User;
use CMV\Team;
use CMV\Models\PM\Project;
use Auth;

class ProjectsController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     * @Get("home", as="app.home", middleware="auth")
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

    /**
     * Store a newly created resource in storage.
     * @Get("project/{slug}", as="project.single")
     * @return Response
     */
    public function single($slug)
    {


        $project = Project::whereSlug($slug)->first();


        return view('projects/single')->with('project', $project);

    }

    /**
     * Store a newly created resource in storage.
     * @Post("project/create", as="project.create")
     * @return Response
     */
    public function create(Request $request)
    {
        
        if(\Auth::guest())
        {

            $user = User::firstOrCreate(['email' => $request->input('email')]);

            $user->name = $request->input('name');

            $user->password = $request->input('password') ? bcrypt($request->input('password')) : bcrypt(date('Y-m-d'));


            $team = Team::firstOrCreate(['name' => $request->input('company_name')]);

            
            $user->joinTeamById($team->id);

            $user->save();

            $team->owner()->associate($user);

            $team->save();


            $projectName = 'A Project Created at '.time().'.';

            $projectData = [
                'name' => $projectName,
                'requested_deadline' => $request->input('lead_deadline'),
            ];

            $project = Project::create($projectData);

            $project->slug = str_replace(' ','-',$projectName);
            $project->subdomain = str_replace(' ','-',$projectName);
            $project->team()->associate($team);

            $project->save();
            
            $project->createOrFindProjectTypeId($request->input('project_type'));

            Auth::login($user);

            $user->switchToTeam($team);

            $user->save();
            return redirect()->route('app.home');

        }

    }
}
