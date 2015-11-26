<?php
namespace CMV\Services;

use CMV\Models\PM\Project;
use CMV\User, CMV\Team;

/**
 * Handles creating threads and messages
 * @todo add permission checks
 * Class ProjectsService
 * @package CMV\Services
 */
class ProjectsService {

    /** @var User  */
    protected $user;

    /** @var Team  */
    protected $team;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->team = $user->currentTeam();
    }

    /**
     * @param User $user
     * @param null $project
     * @throws \Exception
     * @return boolean
     */
    public function addUserToProject(User $user, $project = null)
    {
        $projectTeam = $project->team;

        /** @var Team $team */
        $team = $user->teams()->find($projectTeam->id);
        // check user belongs to the project's team
        if (!$team) {
            throw new \Exception('User doesn\'t belong to the project\'s team');
        }

        if (array_search($team->pivot->role, ['admin', 'owner'])) {
            // admin & owner already has access to all projects
            return true;
        }

        $ids = $project ? [$project->id] : $team->projects->lists('id')->all();
        foreach ($ids as $id) {
            $user->projects()->attach($id);
        }

        return true;
    }

}