<?php

namespace CMV\Http\Controllers\PM;

use CMV\Http\Controllers\API\News;
use CMV\Models\PM\Project;
use CMV\Models\PM\UserNews;
use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

use Auth;

/**
 * @Controller(prefix="concierge-site")
 */
class ConciergeController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     * @Post("create", as="concierge.create")
     * @return Response
     */
    public function create(Request $request)
    {
        $site = Auth::user()->conciergeSites()->create([
            'url' => $request->input('url'),
            'name' => $request->input('name'),
            'project_type' => Project::TYPE_CONCIERGE,
            'project_manager_id' => env('DEFAULT_PM_USER_ID')
        ]);

        $site->slug = strtolower(str_replace(' ','-',$site->name));

        $site->save();

        return redirect()->route('concierge.single', ['slug' => $site->slug]);
    }

    /**
     * Store a newly created resource in storage.
     * @Get("/{slug}", as="concierge.single")
     * @return Response
     */
    public function single($slug)
    {
        $project = Project::where("slug", $slug)
            ->where('project_type', Project::TYPE_CONCIERGE)
            ->firstOrFail();

        $news = UserNews::getNewsByUser(Auth::user(), [1]);

        return view('projects/single', [
            'project' => $project,
            'news' => $news
        ]);
    }

    /**
     * @Get("/{slug}/todos", as="concierge.todos")
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function todos($slug)
    {
        $project = Project::where("slug", $slug)
            ->where('project_type', Project::TYPE_CONCIERGE)
            ->firstOrFail();

        return view('projects/to-dos', [
            'project' => $project
        ]);
    }

    /**
     * @Get("{slug}/files", as="concierge.files")
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function files($slug)
    {
        $project = Project::where("slug", $slug)
            ->where('project_type', Project::TYPE_CONCIERGE)
            ->firstOrFail();

        return view('projects/files', [
            'project' => $project
        ]);
    }
}
