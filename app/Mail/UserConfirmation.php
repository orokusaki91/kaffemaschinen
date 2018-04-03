<?php

namespace App\Mail;

use App\Models\Database\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('shop@centrocaffe.ch')
                    ->subject('Verifizierungsmail für centrocaffe.ch')
                    ->view('front.emails.confirmation')
                    ->with(['token' => $this->user->token,]);
    }
}
