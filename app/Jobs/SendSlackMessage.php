<?php
namespace CMV\Jobs;

use GuzzleHttp\Exception\ServerException;
use CMV\Jobs\Job;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Slack;

/**
 *  This command sends a slack message to our slack account.
 *
 */
class SendSlackMessage extends Job implements SelfHandling, ShouldQueue
{

    use InteractsWithQueue, SerializesModels;

    /**
     * @var
     */
    public $message;

    /**
     * @var string
     */
    public $channel;

    /**
     * @var array
     */
    public $attachments;

    /*
    https://api.slack.com/incoming-webhooks
    https://github.com/maknz/slack

    Sample dispatch array:
    $this->dispatch(new SendSlackMessage("message", "#customer-events", [
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
     * @param $message
     * @param string $channel
     * @param array $attachments
     */
    public function __construct($message, $channel = '#system-events', array $attachments = [])
    {

        $this->channel = $channel;

        if(!isProduction())
        {
            $this->channel = env('LOCAL_SLACK_CHANNEL', '#local-dev');
        }

        $this->message = $message;
        $this->attachments = $attachments;

    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        try {
            if($this->attachments == []) {
                $response = Slack::to($this->channel)->enableMarkdown()->send($this->message);
            } else {
                $response = Slack::to($this->channel)->enableMarkdown()->attach($this->attachments)->send($this->message);
            }

            return $response;
        } catch (ServerException $e) {
            $this->release(60);
        }

    }

}
