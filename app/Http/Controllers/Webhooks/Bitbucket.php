<?php
namespace CMV\Http\Controllers\Webhooks;

use CMV\Models\PM\ConciergeSite;
use CMV\Models\PM\Project;
use CMV\Models\PM\ToDo;
use CMV\Services\MessagesService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Input;

/**
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
     * Creates todo in CMV database if one was created directly in Bitbucket
     * @param array $payload
     */
    protected function issueCreated(array $payload)
    {
        if (!($todo = $this->findTodo($payload['repository']['name'], $payload['issue']['id']))) {
            $reference = $this->findReference($payload['repository']['name']);

            if ($reference) {
                $todo = new ToDo();
                $todo->bitbucket_issue_id = $payload['issue']['id'];
                $todo->title = $payload['issue']['title'];
                $todo->content = $payload['issue']['content']['raw'];
                $todo->reference_type = ToDo::REF_PROJECT;

                $reference->todos()->save($todo);
            }
        }
    }

    /**
     * @todo add comment to ToDo. Figure out which user is author.
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
     * @todo add comment to ToDo. Figure out which user is author.
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
        $reference = $this->findReference($bbSlug);

        if ($reference) {
            $todo = $reference->todos()->where('bitbucket_issue_id', $issueId)->first();

            if ($todo) return $todo;
        }

        return null;
    }

    /**
     * @param $bbSlug
     * @return mixed Project|ConciergeSite
     */
    protected function findReference($bbSlug)
    {
        $project = Project::where('bitbucket_slug', $bbSlug)->first();
        if ($project) return $project;

        return ConciergeSite::where('bitbucket_slug', $bbSlug)->first();
    }
}