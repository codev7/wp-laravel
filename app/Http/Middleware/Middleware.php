<?php
namespace CMV\Http\Middleware;

use Request, Response, Flash;

class Middleware {

    protected function respondWithError($error)
    {
        if (Request::ajax()) {
            return Response::json(['error' => $error])->setStatusCode(400);
        } else {
            Flash::error($error);
            return redirect('/home');
        }
    }

}