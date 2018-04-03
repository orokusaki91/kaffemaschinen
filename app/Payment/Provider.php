<?php

namespace App\Payment;

use App\Payment\Facade as PaymentFacade;
use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->registerPaymentOptions();
    }

    public function register()
    {
        $this->registerPayment();

        $this->app->alias('payment', 'App\Payment\Manager');
    }

    protected function registerPayment()
    {
        $this->app->singleton('payment', function ($app) {
            return new Manager();
        });
    }

    public function provides()
    {
        return ['payment', 'App\Payment\Manager'];
    }

    protected function registerPaymentOptions()
    {
        $cash = new Cash();
        $stripe = new Stripe();
        $pickup = new Pickup();
        PaymentFacade::put($cash->getIdentifier(), $cash);
        PaymentFacade::put($stripe->getIdentifier(), $stripe);
        PaymentFacade::put($pickup->getIdentifier(), $pickup);
    }
}