<?php
namespace CMV\Services;

use CMV\Models\PM\Project;
use CMV\User, CMV\Team;

/**
 * Handles creating threads and messages
 * Class TeamsService
 * @package CMV\Services
 */
class TeamsService {

    /** @var User  */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param User $user
     * @param Team $team
     * @param array $projectIds
     */
    public function syncUserProjects(User $user, Team $team, array $projectIds)
    {
        $teamProjects = $team->projects;

        foreach ($teamProjects as $project) {
            if (array_search($project->id, $projectIds) === false) {
                $this->detachUserFromProject($user, $project);
            } else {
                $this->attachUserToProject($user, $project);
            }
        }
    }

    /**
     * @param User $user
     * @param Project $project
     * @return boolean
     */
    public function attachUserToProject(User $user, Project $project)
    {
        if (!$this->canAttachOrDetachUserToProject($user, $project)) {
            return false;
        }

        if (! $user->projects()->find($project->id) ) {
            $user->projects()->attach($project->id, ['team_id' => $project->team->id]);
        }

        return true;
    }

    /**
     * @param User $user
     * @param Project $project
     * @return boolean
     */
    public function detachUserFromProject(User $user, Project $project)
    {
        if (!$this->canAttachOrDetachUserToProject($user, $project)) {
            return false;
        }

        $user->projects()->detach($project->id, ['team_id' => $project->team->id]);

        return true;
    }

    protected function canAttachOrDetachUserToProject(User $user, Project $project)
    {
        /** @var Team $team */
        $team = $user->teams()->find($project->team->id);

        // check user belongs to the project's team
        if (!$team) {
            throw new \Exception('User doesn\'t belong to the project\'s team');
        }

        if (array_search($team->pivot->role, ['admin', 'owner']) !== false) {
            // admin & owner already has access to all projects
            return false;
        }

        return true;
    }

    /**
     * Return array of team users with their roles and project ids they have access to
     * @param Team $team
     * @return array
     */
    public function users(Team $team)
    {
        $projectIds = $team->projects()->get()->lists('id')->all();

        $roles = \DB::table('user_teams')
            ->where('team_id', $team->id)
            ->get();

        $bindings = \DB::table('user_projects')
            ->where('team_id', $team->id)
            ->get();

        $users = [];

        foreach ($roles as $role) {
            $userInfo = [
                'projects' => [],
                'role' => $role->role
            ];

            if ($role->role == 'member') {
                foreach ($bindings as $binding) {
                    if ($binding->user_id == $role->user_id) {
                        $userInfo['projects'][] = $binding->project_id;
                    }
                }
            } else {
                $userInfo['projects'] = $projectIds;
            }

            $users[$role->user_id] = $userInfo;
        }

        return $users;
    }

    /**
     * @param Project $project
     * @return mixed
     */
    public function getProjectUsers(Project $project)
    {
        $teamMembers = \DB::table('user_teams')
            ->where('team_id', $project->team_id)
            ->whereIn('role', ['admin', 'owner'])
            ->lists('user_id');

        // role=member members of the team are attached only to specific projects
        $projectMembers = \DB::table('user_projects')
            ->where('team_id', $project->team_id)
            ->lists('user_id');

        $ids = array_unique(array_merge($teamMembers, $projectMembers));
        $ids[] = -1;

        return User::whereIn('id', $ids)->get();
    }
}