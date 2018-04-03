<?php

namespace App\Payment;

class Pickup extends Payment implements PaymentInterface
{
    protected $identifier;

    protected $title;

    public function __construct()
    {
        $this->identifier = 'pickup';
        $this->title = 'Pickup From Store';
    }

    public function process($orderData, $cartProducts)
    {
        // TODO: Implement process() method.
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
        return false;
    }
}