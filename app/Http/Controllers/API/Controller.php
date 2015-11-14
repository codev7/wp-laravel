<?php
namespace CMV\Http\Controllers\API;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Validator;
use Response;

class Controller extends BaseController {

    public function __construct()
    {
        // ..
    }

    /**
     * @param Validator $validator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithFailedValidator(Validator $validator)
    {
        return Response::json($validator->getMessageBag()->toArray(), 422);
    }

    /**
     * @param array $data
     */
    protected function respondWithData(array $data)
    {
        return Response::json(['data' => $data]);
    }

    /**
     * @param LengthAwarePaginator $paginator
     */
    protected function respondWithPaginatedData(LengthAwarePaginator $paginator)
    {
        $data = $paginator->getCollection()->toArray();

        $payload = [
            'data' => $data,
            'pagination' => [
                'currentPage' => $paginator->currentPage(),
                'totalItems' => $paginator->total(),
                'itemsPerPage' => $paginator->perPage(),
                'links' => [
                    'next' => $paginator->nextPageUrl(),
                    'previous' => $paginator->previousPageUrl(),
                ]
            ],
        ];

        return Response::json($payload);
    }

    /**
     * @param string $message
     * @return mixed
     */
    protected function respondWithSuccess($message = '')
    {
        $payload = ['status' => 'ok'];
        if ($message) {
            $payload['success'] = $message;
        }

        return Response::json($payload);
    }
}