<?php

namespace App\Shipping;

use Illuminate\Support\Collection;

class Manager
{
    public $shippingOptions;

    public function __construct()
    {
        $this->shippingOptions = Collection::make([]);
    }

    public function all()
    {
        return $this->shippingOptions;
    }

    public function get($identifier)
    {
        return $this->shippingOptions->get($identifier);
    }

    public function put($identifier, $class)
    {
        $this->shippingOptions->put($identifier, $class);

        return $this;
    }
}