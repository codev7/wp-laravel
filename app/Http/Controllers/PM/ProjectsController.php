<?php

namespace CMV\Http\Controllers\PM;

use CMV\Models\PM\ToDo;
use CMV\Models\PM\UserNews;
use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

use CMV\Models\PM\Project;
use Auth;
use Illuminate\Http\Response;

class ProjectsController extends Controller
{

    public function __construct(Request $request)
    {
        $user = Auth::user();

        if ((hasRole('admin') || hasRole('mastermind')) && ($slug = $request->route('slug'))) {
            $project = Project::whereSlug($slug)
                ->whereProjectType(Project::TYPE_PROJECT)
                ->firstOrFail();

            if ($project) {
                if (! $user->teams()->find($project->team_id)) {
                    /** @var \CMV\User $user */
                    $user->joinTeamById($project->team_id, 'owner');
                    $user->current_team_id = $project->team_id;
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     * @Get("home", as="app.home", middleware="auth")
     * @Middleware("must-have-team")
     * @return Response
     */
    public function home()
    {
        return view('projects/home');
    }

    /**
     * Store a newly created resource in storage.
     * @Middleware("access:projects,create")
     * @Get("project/new", as="project.new")
     * @return Response
     */
    public function newProject()
    {
        $team = [];

        if (Auth::check()) {
            $user = Auth::user();
            if ($user && $user->current_team) {
                $team = $user->current_team->toArray();
            }
        }

        return view('projects/new', [
            'state' => ['team' => $team]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @Get("project/{slug}", as="project.single", middleware="auth")
     * @return Response
     */
    public function single($slug)
    {
        $project = Project::whereSlug($slug)
            ->whereProjectType(Project::TYPE_PROJECT)
            ->firstOrFail();

        $news = UserNews::getNewsByUser(Auth::user());

        return view('projects/single')
            ->with('project', $project)
            ->with('news', $news);
    }

    /**
     * Store a newly created resource in storage.
     * @Get("project/{slug}/briefs", as="project.briefs", middleware="auth")
     * @return Response
     */
    public function briefs($slug)
    {
        $project = Project::whereSlug($slug)
            ->whereProjectType(Project::TYPE_PROJECT)
            ->firstOrFail();

        return view('projects/briefs')->with('project', $project);
    }

    /**
     * @Get("project/{slug}/briefs/create", as="project.create_brief", middleware="admin_auth")
     * @return Response
     */
    public function createBrief($slug)
    {
        $project = Project::whereSlug($slug)
            ->whereProjectType(Project::TYPE_PROJECT)
            ->firstOrFail();

        return view('projects/edit-brief')->with('project', $project);
    }


    /**
     * @Get("project/{slug}/briefs/{briefs}", as="project.brief", middleware="auth")
     * @return Response
     */
    public function brief($slug, $brief_id)
    {
        $project = Project::whereSlug($slug)
            ->whereProjectType(Project::TYPE_PROJECT)
            ->firstOrFail();
        $brief = $project->briefs()->findOrFail($brief_id);

        return view('projects/brief')
            ->with('project', $project)
            ->with('brief', $brief);
    }

    /**
     * @Get("project/{slug}/briefs/{briefs}/edit")
     * @param $slug
     * @param $briefId
     * @return Response
     */
    public function editBrief($slug, $briefId)
    {
        $project = Project::whereSlug($slug)
            ->whereProjectType(Project::TYPE_PROJECT)
            ->firstOrFail();

        $brief = $project->briefs()->findOrFail($briefId);

        return view('projects/edit-brief')->with('project', $project)->with('brief', $brief);
    }

    /**
     * Store a newly created resource in storage.
     * @Get("project/{slug}/files", as="project.files", middleware="auth")
     * @return Response
     */
    public function files($slug)
    {
        $project = Project::whereSlug($slug)
            ->whereProjectType(Project::TYPE_PROJECT)
            ->firstOrFail();

        return view('projects/files')->with('project', $project);
    }

    /**
     * Store a newly created resource in storage.
     * @Get("project/{slug}/invoices", as="project.invoices", middleware="auth")
     * @return Response
     */
    public function invoices($slug)
    {
        $project = Project::whereSlug($slug)
            ->whereProjectType(Project::TYPE_PROJECT)
            ->firstOrFail();

        return view('projects/invoices')->with('project', $project);
    }

    /**
     * Store a newly created resource in storage.
     * @Get("project/{slug}/to-dos", as="project.todos", middleware="auth")
     * @return Response
     */
    public function toDos($slug)
    {
        $project = Project::whereSlug($slug)
            ->whereProjectType(Project::TYPE_PROJECT)
            ->firstOrFail();

        return view('projects/to-dos')->with('project', $project);
    }

    /**
     * @Get("project/{slug}/to-dos/{todos}", as="project.todo", middleware="auth")
     * @param $slug
     * @param $toDo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toDo($slug, $toDo)
    {
        $todo = ToDo::find($toDo);
        $todo->load('files');

        return view('projects/to-do', [
            'project' => Project::whereSlug($slug)->first(),
            'todo' => $todo
        ]);
    }
}
