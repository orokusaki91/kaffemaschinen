<?php

namespace App\Shipping;

use Illuminate\Support\Facades\Session;

class Delivery extends Shipping implements ShippingInterface
{
    protected $identifier;
    protected $title;
    protected $amount;

    public function __construct()
    {
        $this->identifier = 'delivery';
        $this->title = 'Delivery';
    }

    public function process($orderData, $cartProducts)
    {
        $this->amount = 0.00;

        foreach ($cartProducts as $product)
        {
            $this->amount += $product['delivery_price'];
        }

        return $this;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAmount()
    {
        $orderData = Session::get('order_data');
        $cartProducts = Session::get('cart');
        $this->process($orderData, $cartProducts);

        return $this->amount;
    }
}