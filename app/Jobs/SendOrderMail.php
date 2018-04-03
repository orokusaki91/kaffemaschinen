<?php

namespace App\Jobs;

use App\Mail\OrderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendOrderMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orders;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new OrderMail($this->orders);

        Mail::to(auth()->user()->email)->send($email);
    }
}