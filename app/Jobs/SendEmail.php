<?php

namespace CMV\Jobs;

use CMV\Jobs\Job;
use CMV\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail, Config;

class SendEmail extends Job implements SelfHandling, ShouldQueue
{

    use InteractsWithQueue, SerializesModels;

    /**
     * @var
     */
    protected $view;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $to;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $from;


    /**
     * Create a new job instance.
     */
    public function __construct($view, array $data, User $to, $subject, $from = null)
    {
        $this->view = $view;
        $this->data = $data;
        $this->to = $to;
        $this->subject = $subject;
        $this->from = $from ? $from : Config::get('mail.from')['address'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send($this->view, $this->data, function ($m) {
            $m->from($this->from, Config::get('mail.from')['name']);

            $m  ->to($this->to->email, $this->to->name)
                ->subject($this->subject);
        });
    }
}
