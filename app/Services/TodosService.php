<?php
namespace CMV\Services;

use CMV\Jobs\SyncToDoWithPT;
use CMV\Models\PM\ConciergeSite;
use CMV\Models\PM\Project;
use CMV\Models\PM\ToDo;
use CMV\User;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Handles creating of todos
 * Class TodosService
 * @package CMV\Services
 */
class TodosService {

    use DispatchesJobs;

    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $reference
     * @param array $data ['title', 'content', 'category', 'type']
     * @return ToDo
     */
    public function createTodo($reference, array $data)
    {
        $todo = new ToDo($data);
        $todo->created_by_id = $this->user->id;
        $todo->reference_id = $reference->id;
        $todo->reference_type = $this->getReftype($reference);
        $todo->status = ToDo::STATUS_NEW;
        if (isset($data['pivotal_story_id'])) {
            $todo['pivotal_story_id'] = $data['pivotal_story_id'];
        }
        $todo->save();
        $todo->load('createdBy');

        $this->dispatch(new SyncToDoWithPT($todo));

        return $todo;
    }

    /**
     * flow:
     * cmv status / bb statue / role to change status to
     * created / new / project member
     * in work / open / developer
     * delivered / resolved / developer
     * rejected / invalid / project member
     * accepted / closed / project member
     *
     * @param ToDo $todo
     * @param string $status
     * @return ToDo
     */
    public function setStatus(ToDo $todo, $status)
    {
        $todo->status = $status;
        $todo->save();

        $this->dispatch(new SyncToDoWithPT($todo));

        return $todo;
    }

    /**
     * @param $reference
     * @return string
     * @throws \Exception
     */
    protected function getReftype($reference)
    {
        if ($reference instanceof Project) {
            return ToDo::REF_PROJECT;
        } else if ($reference instanceof ConciergeSite) {
            return ToDo::REF_CONCIERGE;
        } else {
            throw new \Exception('Unknown entity type. It should be in: project,todo,concierge_site');
        }
    }

    /**
     * @param $referenceType
     * @param $referenceId
     * @throws \Exception
     */
    public static function getReference($referenceType, $referenceId)
    {
        switch($referenceType) {
            case ToDo::REF_PROJECT:
                return Project::find($referenceId);
                break;
            case ToDo::REF_CONCIERGE:
                return ConciergeSite::find($referenceId);
                break;
            default:
                throw new \Exception('Unknown entity type. It should be in: project,todo,concierge_site');
                break;
        }
    }

    /**
     * @param $reference
     * @return User
     */
    public static function findActor($reference)
    {
        if ($reference->developer_id) return $reference->developer;
        if ($reference->project_manager_id) return $reference->projectManager;

        return User::find(env('DEFAULT_PM_USER_ID'));
    }
}