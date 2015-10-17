<?php

namespace CMV\Jobs;

use CMV\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Slack;

class SendLeadToSlack extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $message;
    public $channel;
    public $attachments;

    /*
    *
    Sample dispatch array
    $this->dispatch(new SendSlackMessage("message","#customer-events",[
        'fallback' => 'It is all broken, man', // Fallback text for plaintext clients, like IRC
        'text' => 'It is all broken, man', // The text for inside the attachment
        'pretext' => 'From user: JimBob', // Optional text to appear above the attachment and below the actual message
        'color' => 'bad', // Change the color of the attachment, default is 'good'
        'fields' => [
            [
                'title' => 'Metric 1',
                'value' => 'Some value'
            ],
            [
                'title' => 'Metric 2',
                'value' => 'Some value',
                'short' => true // whether the field is short enough to sit side-by-side other fields, defaults to false
            ]
        ]
    ]));

    */
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $channel = '#general', $attachments = [])
    {
        $this->channel = $channel;

        if(!isProduction())
        {
            $this->channel = env('LOCAL_SLACK_CHANNEL', '#local-dev');
        }
        
        $this->message = $message;
        $this->attachments = $attachments;
    }

    public function queue($queue, $command)
    {
        $queue->pushOn('high_priority', $command);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->attachments == []) {
            $response = Slack::to($this->channel)->enableMarkdown()->send($this->message);
        } else {
            $response = Slack::to($this->channel)->enableMarkdown()->attach($this->attachments)->send($this->message);
        }

        return $response;
    }
}
