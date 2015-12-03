<?php
namespace CMV\Http\Controllers\API;

use CMV\Models\PM\File;
use CMV\Services\FilesService;
use Illuminate\Support\Collection;
use Input, Validator, Auth;

class Files extends Controller {

    /** @var FilesService  */
    protected $service;

    public function __construct()
    {
        $this->service = new FilesService(Auth::user());
    }

    /**
     * @Get("api/files")
     */
    public function index()
    {
        $data = Input::all();

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($data, [
            'reference_type' => 'required|in:project,concierge_site,project_brief',
            'reference_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $reference = FilesService::getReference($data['reference_type'], $data['reference_id']);
        $files = $this->service->all($reference)->with('user')->get();

        return $this->respondWithData($files->toArray());
    }

    /**
     * @Get("api/files/count")
     */
    public function count()
    {
        $data = Input::all();

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($data, [
            'reference_type' => 'required|in:project,concierge_site',
            'reference_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        return $this->respondWithData([
            'count' => FilesService::countByReference($data['reference_type'], $data['reference_id'])
        ]);
    }

    /**
     * @Get("api/files/{files}")
     */
    public function show($id)
    {
        $file = $this->service->find($id);
        $file->load('user');

        return $this->respondWithData($file->toArray());
    }

    /**
     * @Post("api/files")
     */
    public function create()
    {
        $data = Input::all();

        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($data, [
            'reference_type' => 'required|in:project,concierge_site,project_brief',
            'reference_id' => 'required',
            'name' => 'required',
            'originalUrl' => 'required|url',
            'size' => 'required|numeric',
            'uuid' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $reference = FilesService::getReference($data['reference_type'], $data['reference_id']);
        $file = $this->service->create($reference, $data);

        return $this->show($file->id);
    }

    /**
     * @Delete("api/files/{files}")
     * @param $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);

        return $this->respondWithSuccess();
    }

}