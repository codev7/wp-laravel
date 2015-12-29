<?php
namespace CMV\Http\Controllers\Webhooks;

use CMV\Models\PM\Project;
use CMV\Models\PM\ToDo;
use CMV\Services\MessagesService;
use CMV\Services\TodosService;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Input;

/**
 * Class Pivotal
 * @package CMV\Http\Controllers\Webhooks
 */
class Pivotal extends Controller {

    /**
     * @var TodosService
     */
    protected $todosService;

    /**
     * @var Project
     */
    protected $project;

    /**
     * @Post("webhooks/pivotal")
     */
    public function handle(Request $request)
    {
        \Log::info(json_encode([
            'input' => $request->all(),
            'headers' => $request->headers
        ], JSON_PRETTY_PRINT));

        $payload = $request->all();
        $method = camel_case($payload['kind']);

        $this->project = Project::where('pivotal_id', $payload['project']['id'])->firstOrFail();;
        $this->todosService = new TodosService(TodosService::findActor($this->project));

        $this->$method($payload);
    }

    /**
     * @param array $payload
     */
    protected function storyCreateActivity(array $payload)
    {
        $values = $payload['changes'][0]['new_values'];

        if (! ToDo::where('pivotal_story_id', $payload['changes'][0]['id'])->count()) {
            $todo = $this->todosService->createTodo($this->project, [
                'title' => $values['name'],
                'pivotal_story_id' => $payload['changes'][0]['id'],
                'content' => isset($values['description']) ? $values['description'] : '',
                'type' => $values['story_type'],
                'category' => 'other', //?
            ]);
        }
    }

    /**
     * @param array $payload
     */
    protected function storyUpdateActivity(array $payload)
    {
        foreach ($payload['changes'] as $change) {
            if ($change['kind'] != 'story') continue;
            $values = $change['new_values'];

            if (isset($values['current_state'])) {
                $todo = ToDo::where('pivotal_story_id', $change['id'])->firstOrFail();
                $todo->status = $values['current_state'];
                $todo->save();
            }
        }

    }

    /**
     * @param array $payload
     */
    protected function commentCreateActivity(array $payload)
    {
        $values = $payload['changes'][0]['new_values'];

        if (isset($values['current_state'])) {
            $commentId = $values['id'];

            $todo = ToDo::findOrFail($payload['primary_resources'][0]['id']);
            $todo->status = $values['current_state'];
            $todo->save();

            if (! $todo->thread->messages()->where('pivotal_comment_id', $commentId)->count()) {
                $messageService = new MessagesService($this->todosService->getUser());
                $message = $messageService->postInThread($todo->thread, $values['text']);
                $message->pivotal_comment_id = $commentId;
                $message->save();
            }
        }
    }

    /**
     * @param array $payload
     */
    protected function storyDeleteActivity(array $payload)
    {
        foreach ($payload['changes'] as $change) {
            switch($change['kind']) {
                case 'story':
                    ToDo::where('pivotal_story_id', $change['id'])->delete();
                    break;
                case 'comment':
                    ToDo::where('pivotal_comment_id', $change['id'])->delete();
                    break;
            }
        }
    }
}