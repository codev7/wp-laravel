<?php

namespace Laravel\Spark\Teams;

use Carbon\Carbon;
use CMV\Models\PM\Project;
use CMV\Services\TeamsService;
use Laravel\Spark\Spark;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invitations';

    /**
     * The guarded attributes on the model.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * @var array
     */
    protected $casts = [
        'projects' => 'array',
    ];

    /**
     * Get the team that owns the invitation.
     */
    public function team()
    {
        return $this->belongsTo(Spark::model('teams', Team::class), 'team_id');
    }

    /**
     * Determine if the coupon is expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        return Carbon::now()->subWeek()->gte($this->created_at);
    }

    /**
     * Applies invitation to the given user. This adds to team & projects.
     * @param \CMV\User $user
     * @throws \Exception
     */
    public function applyToUser(\CMV\User $user)
    {
        $user->joinTeamById($this->team_id);

        /** @var \CMV\Team $team */
        $team = $this->team;

        $teamsService = new TeamsService($team->owner);
        foreach ($this->projects as $projectId) {
            $project = Project::find($projectId);
            if ($project && $project->team_id == $team->id) {
                $teamsService->attachUserToProject($user, $project);
            }
        }

        $this->delete();
    }
}
