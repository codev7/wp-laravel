<?php
namespace CMV\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Validator;
use Response;

class Controller extends BaseController {

    /**
     * @param Validator $validator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithFaildValidator(Validator $validator)
    {
        return Response::json($validator->getMessageBag()->toArray(), 422);
    }

    /**
     * @param array $data
     */
    protected function respondWithData(array $data)
    {
        return Response::json($data);
    }
}