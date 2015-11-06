<?php

namespace CMV\Console\Commands\Prospector;

use Illuminate\Console\Command;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class ImportActionFromContextIoBccWebHook extends Command implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'context-io:webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from context-io webhook message.';

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
        parent::__construct();
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
            $this->error("Sales rep with email {$from['email']} not found.");
            return;
        }

        $this->info("got email from {$rep->email}");
        foreach($email['addresses']['to'] as $to) {
            $contact = Contact::where(['email' => $to['email']])->first();
            if(!$contact) {
                $this->error("Contact with email {$to['email']} not found");
                Mail::send('emails.contact-not-found', ['email' => $to['email']], function($message) use ($rep)
                {
                    $message->to($rep->email, $rep->name)->subject("Contact not found");
                });
                continue;
            } else {
                $this->info("Log activity for Contact {$contact->email}");
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
