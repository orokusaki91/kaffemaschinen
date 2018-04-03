<?php

namespace App\Shipping;

abstract class Shipping
{
    abstract public function process($orderData, $cartProducts);
}