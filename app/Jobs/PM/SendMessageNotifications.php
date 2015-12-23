<?php

namespace CMV\Jobs\PM;

use CMV\Jobs\Job;
use CMV\Jobs\SendEmail;
use CMV\Models\PM\Message,
    CMV\Models\PM\Project,
    CMV\Models\PM\ToDo,
    CMV\User;
use CMV\Services\TeamsService;
use HashIds;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels,
    Illuminate\Queue\InteractsWithQueue,
    Illuminate\Contracts\Bus\SelfHandling,
    Illuminate\Contracts\Queue\ShouldQueue;

class SendMessageNotifications extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    protected $message;

    /**
     * Create a new job instance.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = $this->message;
        $thread = $message->thread;
        $reference = $thread->reference;

        if (env('APP_ENV') == 'production') {
            $host = 'notifications.codemyviews.com';
        } else {
            $host = 'staging.codemyviews.com';
        }

        $datetime = \Carbon\Carbon::now()->toDayDateTimeString();

        $teamService = new TeamsService(User::first());

        if ($reference instanceof Project) {
            $project = $reference;
        } else if ($reference instanceof ToDo) {
            $project = $reference->reference;
        } else {
            // just in case
            return true;
        }

        $projectMembers = $teamService->getProjectUsers($project);

        foreach ($projectMembers as $member) {
            if ($message->user_id == $member->id) {
                continue;
            }

            $hash = HashIds::encode([$message->thread_id, $member->id]);
            $from = "th-$hash@$host";
            $this->dispatch(new SendEmail('emails.notify_message', [
                'msg' => $message
            ], $member, "[CodeMyViews] Notifications on {$project->name} Project for $datetime ", $from));
        }
    }
}