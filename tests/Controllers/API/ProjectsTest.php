<?php

class ProjectsTest extends CMVTestCase {

    /**
     * @test
     */
    public function testMiddlewares()
    {

    }

    /**
     * "api/projects"
     */
    public function index()
    {
    }

    /**
     * "api/projects/create_and_register"
     */
    public function createAndRegister()
    {
//        $validator = Validator::make($data, [
//            'email' => 'required|unique:users,email',
//            'user_name' => 'required',
//            'company_name' => 'required',
//            'project_name' => 'required',
//            'project_type' => 'required',
//            'requested_deadline' => 'required',
//            'message' => 'required'
//        ]);
    }

    /**
     * "api/projects"
     */
    public function create()
    {
//        $validator = Validator::make($data, [
//            'project_name' => 'required',
//            'project_type' => 'required',
//            'requested_deadline' => 'required',
//            'message' => 'required'
//        ]);
    }

    /**
     * @Put("api/projects/{projects}")
     */
    public function update($id)
    {

//        $validator = Validator::make($data, [
//            'name' => 'required',
//            'developer_id' => 'exists:users,id',
//            'project_manager_id' => 'required|exists:users,id',
//            'project_type_id' => 'required|exists:project_types,id',
//            'status' => 'required|in:'.implode(',', Project::$statuses)
//        ]);
    }

    /**
     * "api/projects/{projects}/create_bb_repository"
     */
    public function createBBRepository()
    {
    }

    /**
     * "api/projects/{projects}/resend_invoice"
     */
    public function resendInvoice()
    {
    }

    /**
     * "api/projects/{projects}/create_staging_site"
     */
    public function createStagingSite()
    {
    }

    /**
     * "api/projects/{projects}"
     */
    public function show($id)
    {
    }
}