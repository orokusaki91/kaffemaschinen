<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Payment\Facade as Payment;
use App\Shipping\Facade as Shipping;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $shippingOptions = Shipping::all();
        $paymentOptions = Payment::all();

        $cartItems = Session::get('cart');
        $hasDelivery = Session::get('hasDelivery');
        $hasPickup = Session::get('hasPickup');

        return view('front.checkout.index')
            ->with('cartItems', $cartItems)
            ->with('shippingOptions', $shippingOptions)
            ->with('paymentOptions', $paymentOptions)
            ->with('hasDelivery', $hasDelivery)
            ->with('hasPickup', $hasPickup);
    }
}