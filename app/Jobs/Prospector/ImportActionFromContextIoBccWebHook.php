<?php

namespace CMV\Jobs\Prospector;

use CMV\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use CMV\Models\Prospector\Activity;
use CMV\Models\Prospector\Contact;
use CMV\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ImportActionFromContextIoBccWebHook extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var message from web hook
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @param array $message
     */
    public function __construct(array $message)
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
        $contextIO = new \ContextIO(env('CONTEXT_IO_API_KEY'), env('CONTEXT_IO_API_SECRET'));
        $messageId = $this->message['message_data']['message_id'];
        Log::info("Working with message {$messageId}");

        $params = [
            'label' => 0, //which means ANY label
            'folder' => 'Inbox',
            'message_id' => $messageId,
            'include_body' => 1
        ];

        $email = $contextIO->getMessage($this->message['account_id'], $params)->getData();

        $from = current($email['addresses']['from']);
        $rep = User::where(['email' => $from['email']])->first();

        if(!$rep) {
            Log::error("Sales rep with email {$from['email']} not found.");
            return;
        }

        Log::info("Got email from {$rep->email}");
        foreach($email['addresses']['to'] as $to) {
            $contact = Contact::where(['email' => $to['email']])->first();
            if(!$contact) {
                Log::error("Contact with email {$to['email']} not found");
                Mail::send('emails.contact-not-found', ['email' => $to['email']], function($message) use ($rep)
                {
                    $message->to($rep->email, $rep->name)->subject("Contact not found");
                });
                continue;
            } else {
                Log::info("Log activity for Contact {$contact->email}");

                // context.io returns two elements in 'bodies' array
                // first element (which we use) is a text\plain version of the message
                // second element is a text\html version, which would look weird as an Activity content
                $emailBody = current($email['bodies']);

                $activity = new Activity();
                $activity->content = "Email Subject: {$email['subject']}\r\nEmail Body:\r\n{$emailBody['content']}";
                $activity->contact()->associate($contact);
                $activity->company()->associate($contact->company()->first());
                $activity->salesRep()->associate($rep);
                $activity->save();
            }
        }
    }
}
