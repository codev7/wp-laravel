<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Message;
use CMV\Models\PM\Thread;
use CMV\Services\MessagesService;
use Input, Validator, Auth;

/**
 * @todo If it's todo related create Bitbucket issue
 * Class Messages
 * @package CMV\Http\Controllers\API
 */
class Messages extends Controller {

    /**
     * @Post("api/messages")
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $data = Input::all();

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($data, [
            'thread_id' => 'exists:threads,id',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $data = Input::all();
        $thread = Thread::find($data['thread_id']);

        $service = new MessagesService(Auth::user());
        $message = $service->postInThread($thread, Auth::user(), $data['content']);

        return $this->show($message->id);
    }

    /**
     * @Get("api/messages/{messages}")
     * @param $id
     */
    public function show($id)
    {
        $message = Message::find($id);

        $this->respondWithData($message->toArray());
    }

}