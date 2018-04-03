<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $contactForm;

    /**
     * Create a new message instance.
     */
    public function __construct($contactForm)
    {
        $this->contactForm = $contactForm;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $email = $this->view('front.emails.contact');

        if (isset($this->contactForm['image'])){
            foreach ($this->contactForm['image'] as $name){
                $email->attach(storage_path().'/app/email/'. $name);
            }
            $email->subject('Wir Kaufen');
        }
        else {
            $email->subject('Kontakt');
        }

        $email->with(['contactForm' => $this->contactForm,]);

        return $email;
    }
}