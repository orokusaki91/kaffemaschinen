<?php

namespace App\Payment;

abstract class Payment
{
    abstract public function process($orderData, $cartProducts);
}