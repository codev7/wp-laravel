<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Message;
use CMV\Models\PM\Thread;
use Input, Validator, Auth;

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
            return $this->respondWithFaildValidator($validator);
        }

        $data = Input::all();
        $thread = Thread::find($data['thread_id']);

        $message = $thread->addMessage(Auth::user(), $data['content']);

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