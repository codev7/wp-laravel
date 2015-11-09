<?php

namespace CMV\Http\Controllers\Prospector;

use CMV\Jobs\Prospector\ImportActionFromContextIoBccWebHook;
use CMV\Http\Requests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;

/**
 * @Controller(prefix="prospector/webhook")
 */
class WebHookController extends Controller
{
    use DispatchesJobs;

    /**
     * @Post("bcc")
     * @return Response
     */
    public function contextIoBccWebHook()
    {
        $request = request()->all();
        if ($request['signature'] == hash_hmac('sha256', $request['timestamp'].$request['token'], env('CONTEXT_IO_API_SECRET'))) {
            $this->dispatch(new ImportActionFromContextIoBccWebHook($request));
        } else {
            return response('Unauthorized.', 401);
        }

        return response('ok');
    }

}   
