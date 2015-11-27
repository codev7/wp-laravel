<?php

namespace Laravel\Spark\Http\Controllers\Settings;

use Exception;
use Illuminate\Http\Request;
use Laravel\Spark\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Laravel\Spark\Contracts\Repositories\TeamRepository;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use CMV\Models\PM\Project;

class InvitationController extends Controller
{
    use ValidatesRequests;

    /**
     * The team repository instance.
     *
     * @var \Laravel\Spark\Contracts\Repositories\TeamRepository
     */
    protected $teams;

    /**
     * Create a new controller instance.
     *
     * @param  \Laravel\Spark\Contracts\Repositories\TeamRepository  $teams
     * @return void
     */
    public function __construct(TeamRepository $teams)
    {
        $this->teams = $teams;

        $this->middleware('auth');
    }

    /**
     * Send an invitation for the given team.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $teamId
     * @return \Illuminate\Http\Response
     */
    public function sendTeamInvitation(Request $request, $teamId)
    {
        $user = $request->user();

        $this->validate($request, [
            'email' => 'required|max:255|email',
            'projects' => 'array'
        ]);

        $team = $user->teams()
                ->where('owner_id', $user->id)
                ->findOrFail($teamId);

        if ($team->invitations()->where('email', $request->email)->exists()) {
            return response()->json(['email' => ['That user is already invited to the team.']], 422);
        }

        $projects = isset($request->projects) ? $request->projects : [];
        $teamProjects = $team->projects()->get()->lists('id')->all();

        $projects = array_get($projects, 0) == '*' ? $teamProjects : array_intersect($projects, $teamProjects);

        $team->inviteUserByEmail($request->email, $projects);

        return $team->fresh(['users', 'invitations']);
    }

    /**
     * Accept the given team invitation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $inviteId
     * @return \Illuminate\Http\Response
     */
    public function acceptTeamInvitation(Request $request, $inviteId)
    {
        $user = $request->user();

        $invitation = $user->invitations()->findOrFail($inviteId);
        $invitation->applyToUser($user);

        return $this->teams->getAllTeamsForUser($user);
    }

    /**
     * Destroy the given team invitation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $teamId
     * @param  string  $inviteId
     * @return \Illuminate\Http\Response
     */
    public function destroyTeamInvitationForOwner(Request $request, $teamId, $inviteId)
    {
        $user = $request->user();

        $team = $user->teams()
                ->where('owner_id', $user->id)
                ->findOrFail($teamId);

        $team->invitations()->where('id', $inviteId)->delete();

        return $this->teams->getTeam($user, $teamId);
    }

    /**
     * Destroy the given team invitation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $inviteId
     * @return \Illuminate\Http\Response
     */
    public function destroyTeamInvitationForUser(Request $request, $inviteId)
    {
        $request->user()->invitations()->findOrFail($inviteId)->delete();
    }
}
