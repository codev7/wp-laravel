<?php
namespace CMV\Http\Controllers\Webhooks;

use Aws\Sns\MessageValidator\Message;
use CMV\Models\PM\Project;
use CMV\Models\PM\Thread;
use CMV\Models\PM\ToDo;
use CMV\Services\MessagesService;
use CMV\Services\TodosService;
use CMV\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Input, HashIds, DOMDocument, DOMXPath;

/**
 * Class Email
 * @package CMV\Http\Controllers\Webhooks
 */
class Email extends Controller {

    /**
     * @Post("webhooks/email/thread")
     */
    public function handle(Request $request)
    {
        \Log::info(print_r($request->all(), true));
        $email = $request->all();
        $email['envelope'] = json_decode($email['envelope'], true);

        $address = $email['envelope']['to'][0];
        list($type, $hash) = explode('-', substr($address, 0, strpos($address, '@')));
        switch ($type) {
            case 'th':
                $this->thread($email, $hash);
                break;
            default:
                exit(0);
        }
    }

    protected function thread(array $email, $hash)
    {
        list($threadId, $userId) = HashIds::decode($hash);

        $thread = Thread::find($threadId);
        $user = User::find($userId);

        if ($thread && $user) {
            $doc = new DOMDocument();
            @$doc->loadHTML($email['html']);
            $selector = new DOMXPath($doc);
            $div = $selector->query('//div[1]')->item(0);

            $service = new MessagesService($user);
            $message = $doc->saveHTML($div);
            \Log::info($message);
            $service->postInThread($thread, $message);
        }

    }

    // ..
}