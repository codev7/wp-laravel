<?php
namespace CMV\Services;

use CMV\Models\PM\ConciergeSite;
use CMV\Models\PM\Project;
use CMV\Models\PM\ToDo;
use CMV\Models\PM\ProjectBrief;
use CMV\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Handles creating of todos
 * Class TodosService
 * @package CMV\Services
 */
class TodosService {

    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        $todo->save();

        // @todo sync with bb

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
     */
    public function setStatus(ToDo $todo, $status)
    {
        $todo->status = $status;
        $todo->save();

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

}