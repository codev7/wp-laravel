<?php

namespace CMV\Http\Controllers\PM;

use CMV\User;
use Illuminate\Http\Request;
use CMV\Http\Requests;
use CMV\Http\Controllers\API\Controller;

use Auth, Input, Validator;
use Illuminate\Http\Response;
use Laravel\Spark\Teams\Invitation;

class InvitationsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @Get("invitation/{token}", as="invitation.register", middleware="guest")
     * @return Response
     */
    public function invitation($token)
    {
        $invitation = Invitation::whereToken($token)->firstOrFail();

        return view('spark::auth/registration/invitation')->with(['invitation' => $invitation]);
    }

    /**
     * @Post("invitation/{token}/register")
     * @param $token
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function registerWithInvitation($token)
    {
        $invitation = Invitation::whereToken($token)->firstOrFail();

        $data = Input::all();
        $validator = Validator::make($data, [
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->respondWithFailedValidator($validator);
        }

        $user = User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => bcrypt($data['password'])
        ]);

        $invitation->applyToUser($user);

        \Auth::login($user);

        return $this->respondWithSuccess();
    }

   
}
