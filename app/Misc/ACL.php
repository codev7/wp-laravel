<?php
namespace CMV\Misc;

use CMV\User, CMV\Models\PM\Project;

class ACL {

    const LEVEL_DELETE = 'delete';

    /**
     * @var \CMV\User
     */
    protected $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    /**
     * @param $model
     * @param string $level
     * @return bool
     */
    public function check($model, $level = null)
    {
        $modelName = lcfirst(last(explode('\\', get_class($model))));

        return $this->$modelName($model, $level);
    }

    /**
     * @param Project $project
     * @param $level
     * @return bool
     */
    protected function project(Project $project, $level)
    {
        if (!$this->user) return false;

        if ($this->user->is_mastermind) {
            return true;
        }

        switch ($level) {
            case static::LEVEL_DELETE:
                return $project->team->owner_id == $this->user->id;
                break;
            default:
                return $project->team && $project->team->users()->find($this->user->id);
                break;
        }
    }
}