<?php

namespace App\Jobs;

use App\Mail\ContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendContactEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contactForm;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contactForm)
    {
        $this->contactForm = $contactForm;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new ContactMail($this->contactForm);

        Mail::to('mail@centrocaffe.ch')->send($email);
    }
}