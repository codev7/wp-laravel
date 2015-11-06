<?php

namespace CMV\Http\Controllers\Prospector;

use CMV\Console\Commands\Prospector\ImportActionFromContextIoBccWebHook;
use CMV\Http\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Queue;

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
        if ($request['signature'] == hash_hmac('sha256', $request['timestamp'].$request['token'], env('CONTEXT_IO_API_SECRET'))) {
            Queue::push(new ImportActionFromContextIoBccWebHook($request));
        } else {
            return response('Unauthorized.', 401);
        }

        return response('ok');
    }

}   
