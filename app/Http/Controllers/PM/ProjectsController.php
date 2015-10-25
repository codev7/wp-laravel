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
     * @Get("project/{slug}", as="project.single", middleware="auth")
     * @return Response
     */
    public function single($slug)
    {


        $project = Project::whereSlug($slug)->first();


        return view('projects/single')->with('project', $project);

    }

    /**
     * Store a newly created resource in storage.
     * @Get("project/{slug}/briefs", as="project.briefs", middleware="auth")
     * @return Response
     */
    public function briefs($slug)
    {
        $project = Project::whereSlug($slug)->first();


        return view('projects/briefs')->with('project', $project);   
    }

    /**
     * Store a newly created resource in storage.
     * @Get("project/{slug}/files", as="project.files", middleware="auth")
     * @return Response
     */
    public function files($slug)
    {
        $project = Project::whereSlug($slug)->first();


        return view('projects/files')->with('project', $project);   
    }

    /**
     * Store a newly created resource in storage.
     * @Get("project/{slug}/invoices", as="project.invoices", middleware="auth")
     * @return Response
     */
    public function invoices($slug)
    {
        $project = Project::whereSlug($slug)->first();


        return view('projects/invoices')->with('project', $project);   
    }

    /**
     * Store a newly created resource in storage.
     * @Get("project/{slug}/to-dos", as="project.todos", middleware="auth")
     * @return Response
     */
    public function toDos($slug)
    {
        $project = Project::whereSlug($slug)->first();


        return view('projects/to-dos')->with('project', $project);   
    }

    /**
     * Store a newly created resource in storage.
     * @Post("project/create", as="project.create")
     * @return Response
     */
    public function create(Request $request)
    {
        
        $projectName = $request->input('project_name');

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

            $projectData = [
                'name' => $projectName,
                'requested_deadline' => $request->input('lead_deadline'),
            ];

            $project = Project::create($projectData);

            $project->slug = str_replace(' ','-',strtolower($projectName));
            $project->team()->associate($team);

            $project->save();
            
            $project->createOrFindProjectTypeId($request->input('project_type'));

            Auth::login($user);

            $user->switchToTeam($team);

            $user->save();

        }
        else
        {
            //user already logged in
            
            $projectData = [
                'name' => $projectName,
                'requested_deadline' => $request->input('lead_deadline'),
            ];

            $project = Project::create($projectData);

            $project->slug = str_replace(' ','-',strtolower($projectName));
            $project->team()->associate(Auth::user()->currentTeam());

            $project->save();
            
            $project->createOrFindProjectTypeId($request->input('project_type'));
        }


        return redirect()->route('project.single', ['slug' => $project->slug]);
    }
}
