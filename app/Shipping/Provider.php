<?php

namespace App\Shipping;

use Illuminate\Support\ServiceProvider;
use App\Shipping\Facade as ShippingFacade;

class Provider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->registerShippingOption();
    }

    public function register()
    {
        $this->registerShipping();

        $this->app->alias('shipping', 'App\Shipping\Manager');
    }

    public function registerShipping()
    {
        $this->app->singleton('shipping', function($app) {
            return new Manager();
        });
    }

    public function provides()
    {
        return ['shipping', 'App\Shipping\Manager'];
    }

    protected function registerShippingOption()
    {
        $freeShipping = new FreeShipping();
        $delivery = new Delivery();

        ShippingFacade::put($freeShipping->getIdentifier(), $freeShipping);
        ShippingFacade::put($delivery->getIdentifier(), $delivery);
    }
}