<?php
namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $orders;

    /**
     * Create a new message instance.
     */
    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $email = $this->view('front.emails.orderTXT')->with('orders', $this->orders);
        $email->from('sale@centrocaffe.ch');

        $pdf = PDF::loadView('front.emails.orderPDF', ['orders' => $this->orders]);
        $name = time() . '.pdf';
        $pdf->save(storage_path().'/app/email/'. $name);

        $email->attach(storage_path().'/app/email/'. $name);

        return $email;
    }
}