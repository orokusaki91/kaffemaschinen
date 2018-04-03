<?php

namespace App\Shipping;

interface ShippingInterface
{
    public function getIdentifier();

    public function getTitle();

    public function getAmount();
}