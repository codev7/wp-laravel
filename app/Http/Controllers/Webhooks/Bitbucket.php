<?php
namespace CMV\Http\Controllers\Webhooks;

use CMV\Models\PM\Project;
use CMV\Models\PM\ToDo;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Input;

/**
 * @todo Add logic for concierge sites
 * Class Bitbucket
 * @package CMV\Http\Controllers\Webhooks
 */
class Bitbucket extends Controller {

    /**
     * @Post("webhooks/bitbucket")
     */
    public function handle(Request $request)
    {
        $hookUID = $request->header('x-hook-uuid');
        $hookEvent = $request->header('x-event-key');

        $i = \Input::all();
        $i[] = $hookEvent;

        $parts = explode(':', $hookEvent);
        $method = $parts[0] . ucfirst($parts[1]);

        $payload = Input::all();

        $this->$method($payload);
    }

    /**
     * @param array $payload
     */
    protected function issueCreated(array $payload)
    {
        if (!($todo = $this->findTodo($payload['repository']['name'], $payload['issue']['id']))) {
            $project = Project::where('bitbucket_slug', $payload['repository']['name'])->first();

            if ($project) {
                $todo = new ToDo();
                $todo->bitbucket_issue_id = $payload['issue']['id'];
                $todo->title = $payload['issue']['title'];
                $todo->content = $payload['issue']['content']['raw'];
                $todo->reference_type = ToDo::REF_PROJECT;

                $project->todos()->save($todo);
            }
        }
    }

    /**
     * @param array $payload
     */
    protected function issueUpdated(array $payload)
    {
        if ($todo = $this->findTodo($payload['repository']['name'], $payload['issue']['id'])) {
            if ($payload['comment']['content']['raw']) {
                $todo->comment_count++;
            }
            $todo->status = $payload['changes']['status']['new'];
            $todo->save();
        }
    }

    /**
     * @param array $payload
     */
    protected function issueComment_created(array $payload)
    {
        if ($todo = $this->findTodo($payload['repository']['name'], $payload['issue']['id'])) {
            $todo->comment_count++;
            $todo->save();
        }
    }

    /**
     * @param $bbSlug
     * @param $issueId
     * @return mixed
     */
    protected function findTodo($bbSlug, $issueId)
    {
        $project = Project::where('bitbucket_slug', $bbSlug)->first();

        if ($project) {
            $todo = $project->todos()->where('bitbucket_issue_id', $issueId)->first();

            if ($todo) return $todo;
        }

        return null;
    }
}