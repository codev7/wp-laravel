<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\Thread;
use CMV\Services\MessagesService;
use Input, Validator, Auth;

class Threads extends Controller {

    /**
     * @Get("api/threads")
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = Input::all();

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($data, [
            'reference_type' => 'required|in:project,concierge_site',
            'reference_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $threads = Thread::with('messages', 'messages.user')
            ->where('reference_type', $data['reference_type'])
            ->where('reference_id', $data['reference_id'])
            ->get();

        return $this->respondWithData($threads->toArray());
    }

    /**
     * @Post("api/threads/{threads}")
     */
    public function show($id)
    {
        /** @var Thread $thread */
        $thread = Thread::find($id);
        $thread->load('messages');

        return $this->respondWithData($thread->toArray());
    }

    /**
     * @Post("api/threads")
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $data = Input::all();

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($data, [
            'reference_type' => 'required_unless:thread_id|in:project,concierge_site',
            'reference_id' => 'required_unless:thread_id',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $data = Input::all();

        $service = new MessagesService(Auth::user());
        $reference = $service::getReference($data['reference_type'], $data['reference_id']);

        $message = $service->postInNewThread($reference, $data['content']);

        return $this->show($message->thread->id);
    }

}