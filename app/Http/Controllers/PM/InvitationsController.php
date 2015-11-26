<?php

namespace CMV\Http\Controllers\PM;

use CMV\Models\PM\UserNews;
use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\Controller;

use CMV\User;
use CMV\Team;
use CMV\Models\PM\Project;
use Auth;
use Illuminate\Http\Response;
use Laravel\Spark\Teams\Invitation;

class InvitationsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @Get("invitation/{token}", as="invitation.register", middleware="guest")
     * @Middleware("must-have-team")
     * @return Response
     */
    public function invitation($token)
    {      

        $invitation = Invitation::whereToken($token)->firstOrFail();

        
        return view('spark::auth/registration/invitation')->with(['invitation' => $invitation]);
    }

   
}
