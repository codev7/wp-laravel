<?php
namespace CMV\Misc;

use CMV\Models\PM\ProjectBrief;
use CMV\Models\PM\ToDo;
use CMV\User, CMV\Models\PM\Project;

class ACL {

    const ACTION_CREATE = 'create';
    const ACTION_READ   = 'read';
    const ACTION_UPDATE = 'update';
    const ACTION_DELETE = 'delete';

    /**
     * @var \CMV\User
     */
    protected $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
    }

    /**
     * @param $model
     * @param string $action
     * @return bool
     */
    public function check($model, $action = null)
    {
        $modelName = lcfirst(last(explode('\\', get_class($model))));

        return $this->$modelName($model, $action);
    }

    /**
     * @param Project $project
     * @param $action
     * @return bool
     */
    protected function project(Project $project, $action = 'read')
    {
        if ($this->user && ($this->user->is_mastermind || $this->user->is_admin)) {
            return true;
        }

        if (! $project->exists) {
            switch ($action) {
                case self::ACTION_READ:
                    return is_null($this->user);
                case self::ACTION_CREATE:
                    if (!$this->user || !$this->user->current_team_id) {
                        return true;
                    }
                    return array_search($this->user->currentTeam()->pivot->role, ['admin', 'owner']) !== false;
                default:
                    return false;
            }
        }

        if (!$this->user) return false;

        switch ($action) {
            case static::ACTION_DELETE:
                return $project->team->owner_id == $this->user->id;
                break;
            default:
                $team = $this->user->teams()->find($project->team_id);
                if (array_search($team->pivot->role, ['admin', 'owner']) !== false) {
                    return true;
                }

                return (bool) \DB::table('user_projects')
                    ->where('team_id', $project->team_id)
                    ->where('project_id', $project->id)
                    ->where('user_id', $this->user->id)
                    ->count();
                break;
        }
    }

    /**
     * @param ProjectBrief $brief
     * @param $action
     * @return bool
     */
    protected function projectBrief(ProjectBrief $brief, $action)
    {
        if (!$this->user) return false;

        if ($this->user->isMastermind() || $this->user->isAdministrator()) {
            return true;
        }

        if (!$brief->exists) {
            switch ($action) {
                case self::ACTION_READ:
                    return true;
                case self::ACTION_CREATE:
                    return $this->user->isMastermind() || $this->user->isAdministrator();
                default:
                    return false;
            }
        }
        switch ($action) {
            case 'approve':
            case 'send-to-client':
            case self::ACTION_UPDATE:
            case self::ACTION_DELETE:
                return $this->user->isMastermind() || $this->user->isAdministrator();
            case 'request-changes':
            case self::ACTION_READ:
                return (bool) $brief->approved_by_admin_id;
            default:
                return false;
        }
    }

    /**
     * @param ToDo $todo
     * @param $action
     * @return bool
     */
    public function todo(ToDo $todo, $action)
    {
        return true;
    }

}