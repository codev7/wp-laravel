<?php

namespace CMV\Console\Commands\PM;

use CMV\Jobs\SendEmail;
use CMV\Models\PM\MessageNotification;
use CMV\Models\PM\Project;
use CMV\Services\TeamsService;
use CMV\User;
use Illuminate\Console\Command;
use DB, HashIds;
use Illuminate\Foundation\Bus\DispatchesJobs;

class NotifyAboutMessages extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:thread_messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (env('APP_ENV') == 'production') {
            $host = 'notifications.codemyviews.com';
        } else {
            $host = 'staging.codemyviews.com';
        }

        // get all messages which weren't notified about (filter by contents of the message_notification table)
        $messages = DB::table('messages')
            ->select(
                'threads.id as thread_id',
                'messages.user_id as user_id',
                'messages.id as message_id',
                'messages.content',
                'messages.created_at',
                'users.name as user_name',
                'projects.id as project_id',
                'projects.name as project_name'
            )
            ->join('threads', 'threads.id', '=', 'messages.thread_id')
            ->leftJoin('message_notifications', 'message_notifications.thread_id', '=', 'messages.thread_id')
            ->leftJoin('users', 'users.id', '=', 'messages.user_id')
            ->join('projects', 'projects.id', '=', 'threads.reference_id')
            ->where('threads.reference_type', 'project')
            ->where(function($sub) {
                $sub->whereRaw('messages.id > message_notifications.message_id')
                    ->orWhereNull('message_notifications.message_id');
            })
            ->orderBy('messages.id', 'asc')
            ->get();

        $threads = [];
        foreach ($messages as $message) {
            $threadId = $message->thread_id;

            if (!isset($threads[$threadId])) {
                $threads[$threadId] = [];
            }
            $threads[$threadId][] = $message;
        }

        $datetime = \Carbon\Carbon::now()->toDayDateTimeString();

        // one project == 1 email
        $teamService = new TeamsService(User::first());
        foreach ($threads as $thread) {
            $posters = std_column($thread, 'user_id');
            $project = Project::find($thread[0]->project_id);
            $projectMembers = $teamService->getProjectUsers($project);

            foreach ($projectMembers as $member) {
                if (count($posters) == 1 && $posters[0] == $member->id) {
                    continue;
                }

                $hash = HashIds::encode([$thread[0]->thread_id, $member->id]);
                $from = "th-$hash@$host";
                $this->dispatch(new SendEmail('emails.notify_messages', [
                    'messages' => $thread
                ], $member, "[CodeMyViews] Notifications on {$thread[0]->project_name} Project for $datetime ", $from));
            }
            $notification = MessageNotification::firstOrNew(['thread_id' => $thread[0]->thread_id]);
            $notification->message_id = end($thread)->message_id;
            $notification->save();
        }
    }
}
