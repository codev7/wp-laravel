<?php

class TodosTest extends CMVTestCase {

    /**
     * @test
     */
    public function testMiddlewares()
    {

    }

    /**
     * "api/todos"
     */
    public function index()
    {
//        $validator = Validator::make($data, [
//            'reference_type' => 'required|in:project,concierge_site',
//            'reference_id' => 'required',
//        ]);
    }

    /**
     * "api/todos"
     */
    public function create()
    {
//        $validator = Validator::make($data, [
//            'reference_type' => 'required|in:project,concierge_site',
//            'reference_id' => 'required',
//            'title' => 'required',
//            'content' => 'required',
//            'category' => 'required|in:frontend,wordpress,other',
//            'type' => 'required|in:bug,feature'
//        ]);
    }

    /**
     * "api/todos/{todos}/set-status"
     */
    public function updateStatus()
    {
//        $validator = Validator::make($data, [
//            'status' => 'required|in:started,accepted,rejected,delivered'
//        ]);
    }

    /**
     * "api/todos/{todos}/comments"
     */
    public function comments()
    {

    }

}