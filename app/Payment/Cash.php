<?php

namespace App\Payment;

class Cash extends Payment implements PaymentInterface
{
    protected $identifier;

    protected $title;

    public function __construct()
    {
        $this->identifier = 'cash';
        $this->title = 'Cash';
    }

    public function process($orderData, $cartProducts)
    {

    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function isEnabled()
    {
        return true;
    }
}