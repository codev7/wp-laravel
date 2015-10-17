&#x3C;?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Slack;

/**
 *  This command sends a slack message to our slack account.
 *
 */
class SendSlackMessage extends Command implements SelfHandling, ShouldBeQueued
{

    use InteractsWithQueue, SerializesModels;

    public $message;
    public $channel;
    public $attachments;

    /*
    *
    Sample dispatch array
    $this-&#x3E;dispatch(new SendSlackMessage(&#x22;message&#x22;,&#x22;#customer-events&#x22;,[
        &#x27;fallback&#x27; =&#x3E; &#x27;It is all broken, man&#x27;, // Fallback text for plaintext clients, like IRC
        &#x27;text&#x27; =&#x3E; &#x27;It is all broken, man&#x27;, // The text for inside the attachment
        &#x27;pretext&#x27; =&#x3E; &#x27;From user: JimBob&#x27;, // Optional text to appear above the attachment and below the actual message
        &#x27;color&#x27; =&#x3E; &#x27;bad&#x27;, // Change the color of the attachment, default is &#x27;good&#x27;
        &#x27;fields&#x27; =&#x3E; [
            [
                &#x27;title&#x27; =&#x3E; &#x27;Metric 1&#x27;,
                &#x27;value&#x27; =&#x3E; &#x27;Some value&#x27;
            ],
            [
                &#x27;title&#x27; =&#x3E; &#x27;Metric 2&#x27;,
                &#x27;value&#x27; =&#x3E; &#x27;Some value&#x27;,
                &#x27;short&#x27; =&#x3E; true // whether the field is short enough to sit side-by-side other fields, defaults to false
            ]
        ]
    ]));

    */

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($message, $channel = &#x27;#system-events&#x27;, $attachments = [])
    {   

        $this-&#x3E;channel = $channel;

        if(!isProduction())
        {
            $this-&#x3E;channel = env(&#x27;LOCAL_SLACK_CHANNEL&#x27;, &#x27;#local-dev&#x27;);
        }
        
        $this-&#x3E;message = $message;
        $this-&#x3E;attachments = $attachments;

    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        if($this-&#x3E;attachments == [])
        {
            return Slack::to($this-&#x3E;channel)-&#x3E;enableMarkdown()-&#x3E;send($this-&#x3E;message);    
        }
        
        return Slack::to($this-&#x3E;channel)-&#x3E;enableMarkdown()-&#x3E;attach($this-&#x3E;attachments)-&#x3E;send($this-&#x3E;message);
    }

}