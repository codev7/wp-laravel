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

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Project
     */
    protected $project;

    /**
     * @param User $user
     * @param Project $project
     */
    public function __construct(User $user, Project $project)
    {
        $this->user = $user;
        $this->project = $project;
    }

    /**
     * @param Project $project
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function all()
    {
        return $this->project->briefs();
    }

    /**
     * @param array $data
     * @return ProjectBrief
     */
    public function create(array $data)
    {
        $brief = new ProjectBrief();

        $brief->text = $data['brief'];
        $brief->created_by_id = $this->user->id;
        $brief->project_id = $this->project->id;
        $brief->save();

        return $brief;
    }

    /**
     * @param Brief $brief
     * @param array $data
     * @return Brief
     */
    public function update(ProjectBrief $brief, array $data)
    {
        $brief->text = $data['brief'];
        $brief->save();

        return $brief;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return ProjectBrief::find($id);
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

    /**
     * @return Array
     */
    public static function templates()
    {
        return [
            'wordpress' => json_decode(view('misc.briefs.wordpress')),
            'frontend' => json_decode(view('misc.briefs.frontend')),
            'other' => json_decode(view('misc.briefs.other')),
            'blanks' => json_decode(view('misc.briefs.blanks')),
        ];
    }

}