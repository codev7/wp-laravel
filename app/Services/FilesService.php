<?php
namespace CMV\Services;

use CMV\Models\PM\File, CMV\Models\PM\Project, CMV\Models\PM\ConciergeSite;
use CMV\User;
use Illuminate\Support\Collection;

/**
 * Handles creating threads and messages
 * @todo add permission checks
 * Class FilesService
 * @package CMV\Services
 */
class FilesService {

    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param Project|ConciergeSite $reference
     * @return Collection
     */
    public function all($reference)
    {
        return $reference->files();
    }

    /**
     * @param Project|ConciergeSite $reference
     * @param array $data ['path', 'name', 'mime', 'size']
     * @return File
     */
    public function create($reference, array $data)
    {
        $data = array_only($data, ['path', 'name', 'mime', 'size']);

        $file = new File();
        $file->reference_type = $this->getReftype($reference);
        $file->reference_id = $reference->id;
        $file->user_id = $this->user->id;
        foreach ($data as $column => $value) {
            $file->column = $value;
        }
        $file->save();

        return $file;
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
     * @param $reference
     * @return string
     * @throws \Exception
     */
    protected function getReftype($reference)
    {
        if ($reference instanceof Project) {
            return File::REF_PROJECT;
        } else if ($reference instanceof ConciergeSite) {
            return File::REF_PROJECT;
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
            case Thread::REF_PROJECT:
                return Project::find($referenceId);
                break;
            case Thread::REF_CONCIERGE:
                return ConciergeSite::find($referenceId);
                break;
            default:
                throw new \Exception('Unknown entity type. It should be in: project,todo,concierge_site');
                break;
        }
    }

}