<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Message;
use CMV\Models\PM\Thread;
use CMV\Models\PM\ToDo;
use CMV\Services\MessagesService;
use Input, Validator, Auth;

/**
 * Class Messages
 * @package CMV\Http\Controllers\API
 */
class Messages extends Controller {

    /**
     * @Post("api/threads/{threads}/messages")
     * @return \Illuminate\Http\JsonResponse
     */
    public function create($id)
    {
        $data = Input::all();
        $data['thread_id'] = $id;

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($data, [
            'thread_id' => 'exists:threads,id',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $thread = Thread::find($data['thread_id']);

        $service = new MessagesService(Auth::user());
        $message = $service->postInThread($thread, "<div>{$data['content']}</div>");

        if ($thread->reference instanceof ToDo) {
            try {
                $todo = $thread->reference;
                $project = $todo->reference;
                $comment = \Pivotal::createComment($project->pivotal_id, $todo->pivotal_story_id, $data['content']);
                $message->pivotal_comment_id = $comment->id;
            } catch (\Exception $e) {
            }
        }

        return $this->show($message->id);
    }

    /**
     * @Get("api/messages/{messages}")
     * @param $id
     */
    public function show($id)
    {
        $message = Message::find($id);
        $message->load('user');

        return $this->respondWithData($message->toArray());
    }

}