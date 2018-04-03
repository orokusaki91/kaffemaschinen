<?php

namespace App\Payment;

interface PaymentInterface
{
    public function getIdentifier();

    public function getTitle();

    public function isEnabled();
}