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
            'reference_type' => 'required|in:project,concierge_site',
            'reference_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondWithFaildValidator($validator);
        }

        $reference = FilesService::getReference($data['reference_type'], $data['reference_id']);
        $files = $this->service->all($reference);

        return $this->respondWithData($files->toArray());
    }

    /**
     * @Get("api/files/{files}")
     */
    public function show($id)
    {
        $file = $this->service->find($id);

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
            'reference_type' => 'in:project,concierge_site',
            'reference_id' => 'required_if:reference_type',
            'name' => 'required',
            'path' => 'required|url',
            'mime' => 'required',
            'size' => 'numeric',
        ]);

        if ($validator->fails()) {
            return $this->respondWithFaildValidator($validator);
        }

        $reference = FilesService::getReference($data['reference_type'], $data['reference_id']);
        $file = $this->service->create($reference, $data);

        return $this->show($file->id);
    }
}