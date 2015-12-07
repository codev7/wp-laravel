<?php
namespace CMV\Services;

use CMV\Models\PM\File, CMV\Models\PM\Project;
use CMV\Models\PM\ProjectBrief;
use CMV\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * @return HasMany
     */
    public function all()
    {
        $query = $this->project->briefs();

        if ($this->user->is_admin == false) {
            $query->whereNotNull('approved_by_admin_id');
        }

        return $query;
    }

    /**
     * @param array $data
     * @return ProjectBrief
     */
    public function create(array $data)
    {
        $brief = new ProjectBrief();

        $brief->text = $this->processText($data['brief']);
        $brief->created_by_id = $this->user->id;
        $brief->project_id = $this->project->id;
        $brief->save();

        return $brief;
    }

    /**
     * @param ProjectBrief $brief
     * @param array $data
     * @return ProjectBrief
     */
    public function update(ProjectBrief $brief, array $data)
    {
        $brief->text = $this->processText($data['brief']);
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
    public function sendToClient(ProjectBrief $brief)
    {
        $brief->approved_by_admin_id = $this->user->id;
        $brief->approved_by_admin_at = \Carbon\Carbon::now();
        $brief->save();

        return $brief;
    }

    /**
     * @param ProjectBrief $brief
     * @return ProjectBrief
     */
    public function approve(ProjectBrief $brief)
    {
        $brief->approved_by_customer_id = $this->user->id;
        $brief->approved_by_customer_at = \Carbon\Carbon::now();
        $brief->save();

        return $brief;
    }

    /**
     * @param array $text
     * @return array
     */
    protected function processText(array $text)
    {
        if ($text['brief_type'] == ProjectBrief::TYPE_FRONTEND) {
            foreach ($text['views'] as $i => $view) {
                if (!isset($view['_id'])) {
                    $text['views'][$i]['_id'] = random_str();
                }
            }
        }

        return $text;
    }

}