<?php
namespace CMV\Services;

use CMV\Models\PM\ConciergeSite;
use CMV\Models\PM\Message;
use CMV\Models\PM\Project;
use CMV\Models\PM\Thread;
use CMV\Models\PM\ToDo;
use CMV\User;

/**
 * Handles creating threads and messages
 * @todo add permission checks
 * Class MessagesService
 * @package CMV\Services
 */
class MessagesService {

    protected $author;

    /**
     * @param User $author
     */
    public function __construct(User $author)
    {
        $this->author = $author;
    }

    /**
     * @param $reference
     * @param $content
     * @return Message
     */
    public function postInFirstOrNewThread($reference, $content)
    {
        $thread = $this->firstOrCreateThread($reference);
        return $thread->addMessage($this->author, $content);
    }

    /**
     * @param $reference
     * @param $content
     * @return Message
     */
    public function postInNewThread($reference, $content)
    {
        $thread = $this->createThread($reference);
        return $thread->addMessage($this->author, $content);
    }

    /**
     * @param Thread $thread
     * @param $content
     * @return Message
     */
    public function postInThread(Thread $thread, $content)
    {
        return $thread->addMessage($this->author, $content);
    }

    /**
     * @param $reference
     * @return Thread
     */
    protected function createThread($reference)
    {
        $thread = new Thread();
        $thread->reference_type = $this->getReftype($reference);
        $thread->reference_id = $reference->id;
        $thread->save();

        return $thread;
    }

    /**
     * @param $reference
     * @return Thread
     */
    protected function firstOrCreateThread($reference)
    {
        $thread = Thread::where('reference_type', $this->getReftype($reference))
            ->where('reference_id', $reference->id)
            ->first();

        if ($thread) return $thread;

        return $this->createThread($reference);
    }

    /**
     * @param $reference
     * @return string
     * @throws \Exception
     */
    protected function getReftype($reference)
    {
        if ($reference instanceof Project) {
            return Thread::REF_PROJECT;
        } else if ($reference instanceof ToDo) {
            return Thread::REF_PROJECT;
        } else if ($reference instanceof ConciergeSite) {
            return Thread::REF_PROJECT;
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
            case Thread::REF_TODO:
                return ToDo::find($referenceId);
                break;
            default:
                throw new \Exception('Unknown entity type. It should be in: project,todo,concierge_site');
                break;
        }
    }


}