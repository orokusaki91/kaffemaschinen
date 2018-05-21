<?php
namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;
use Session;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $orders;
    protected $user;

    /**
     * Create a new message instance.
     */
    public function __construct($orders, $user)
    {
        $this->orders = $orders;
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $email = $this->view('front.emails.orderTXT', with(['orders' => $this->orders, 'user' => $this->user]));
        $email->from('sale@centrocaffe.ch');

        $pdf = PDF::loadView('front.emails.orderPDF', ['orders' => $this->orders, 'user' => $this->user]);
        $name = time() . '.pdf';
        $pdf->save(storage_path().'/app/email/'. $name);
        $email->attach(storage_path().'/app/email/'. $name);

        Session::put('pdf_path', storage_path().'/app/email/'. $name);

        return $email;
    }
}