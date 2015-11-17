<?php
namespace CMV\Services;

use CMV\Models\PM\File, CMV\Models\PM\Project;
use CMV\Models\PM\ProjectBrief;
use CMV\User;
use Illuminate\Support\Collection;

/**
 * Handles creating threads and messages
 * @todo add permission checks
 * Class BriefsService
 * @package CMV\Services
 */
class BriefsService {

    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Project $project
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function all(Project $project = null)
    {
        if ($project) {
            return $project->briefs();
        } else {
            return ProjectBrief::query();
        }
    }

    /**
     * @param Project $project
     * @param array $data
     * @return ProjectBrief
     */
    public function create(Project $project, array $data)
    {
        $brief = new ProjectBrief();

        $brief->text = $data['text'];
        $brief->create_by_id = $this->user->id;
        $brief->project_id = $project->id;
        $brief->save();

        return $brief;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return File::find($id);
    }

    /**
     * @param ProjectBrief $brief
     * @return ProjectBrief
     */
    public function approve(ProjectBrief $brief)
    {
        $brief->approved_by_customer_id = $this->user->id;
        $brief->save();

        return $brief;
    }

}