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
     * Create a new command instance.
     *
     * @param array $message
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $contextIO = new \ContextIO(env('CONTEXT_IO_API_KEY'), env('CONTEXT_IO_API_SECRET'));
        $accountId = $this->message['account_id'];
        $messageId = $this->message['message_data']['message_id'];

        $params = [
            'label' => 0,
            'folder' => 'Inbox',
            'message_id' => $messageId
        ];

        $email = $contextIO->getMessage($accountId, $params)->getData();

        $from = current($email['addresses']['from']);
        $rep = User::where(['email' => $from['email']])->first();

        if(!$rep) {
            Log::error("Sales rep with email {$from['email']} not found.");
            return;
        }

        Log::info("got email from {$rep->email}");
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
