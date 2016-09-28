<?php

namespace OrionMedical\Jobs;

use OrionMedical\Models\Customer;
use OrionMedical\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $emailAddress;

    /**
     * Create a new job instance.
     *
     * @param $emailAddress
     */
    public function __construct(Customer $fullname)
    {
        $this->fullname = $fullname;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
            $mailer->send('email.welcome', ['fullname'=>$this->fullname], function($message) {
            $message->from(env('MAIL_FROM'), 'Queue Test Sender');
            $message->to($this->email)->subject('Welcome Email');
        });
    }
}
