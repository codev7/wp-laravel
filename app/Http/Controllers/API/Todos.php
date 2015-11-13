<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\ToDo;
use Input, Validator, Auth, App;

class Todos extends Controller {

    /**
     * @Get("api/todos")
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

        $items = ToDo::with('messages', 'messages.user')
            ->where('reference_type', $data['reference_type'])
            ->where('reference_id', $data['reference_id'])
            ->get();

        return $this->respondWithData($items->toArray());
    }

    /**
     * @Post("api/todos")
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

        $thread = new Thread();
        $thread->reference_type = $data['reference_type'];
        $thread->referenct_id = $data['reference_id'];
        $thread->save();

        $thread->addMessage(Auth::user(), $data['content']);
    }

    /**
     * @Get("api/todos/{todos}/comments")
     * @param $id
     */
    public function comments($id)
    {
        $todo = ToDo::find($id);
        $comments = $todo->comments();

        return $this->respondWithData($comments);
    }

}