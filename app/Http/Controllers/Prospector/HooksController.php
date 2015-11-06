<?php

namespace CMV\Http\Controllers\Prospector;

use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

/**
 * @Controller(prefix="prospector/webhook")
 */
class HooksController extends Controller
{
    /**
     * @Post("bcc")
     * @return Response
     */
    public function contextIoBccWebHook()
    {
        $request = request()->all();
        \Log::info(json_encode($request));
        return 'ok';
    }

}   
