<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\ToDo;
use CMV\Services\TodosService;
use Input, Validator, Auth, App;

/**
 * Class Todos
 * @package CMV\Http\Controllers\API
 */
class Todos extends Controller {

    /**
     * @var TodosService
     */
    protected $service;

    /**
     *
     */
    public function __construct()
    {
        $this->service = new TodosService(Auth::user());
    }

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

        $items = ToDo::with('comments', 'comments.user')
            ->where('reference_type', $data['reference_type'])
            ->where('reference_id', $data['reference_id'])
            ->orderBy('id', 'desc')
            ->with('createdBy')
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
            'reference_type' => 'required|in:project,concierge_site',
            'reference_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'category' => 'required|in:frontend,wordpress,other',
            'type' => 'required|in:bug,feature'
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $reference = TodosService::getReference($data['reference_type'], $data['reference_id']);
        $todo = $this->service->createTodo($reference, $data);

        return $this->respondWithData($todo->toArray());
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