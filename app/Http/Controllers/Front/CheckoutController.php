<?php

namespace App\Http\Controllers\Front;

use Auth;
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

        if (Session::has('cart')) {
            if (Auth::check()) {
                $user = Auth::user();
            } elseif (Session::has('guest_user')) {
                $user = Session::get('guest_user');
            } else {
                return redirect()->route('order.login');
            }
        } else {
            return redirect()->route('cart.view');
        }

        return view('front.checkout.index')
            ->with('cartItems', $cartItems)
            ->with('shippingOptions', $shippingOptions)
            ->with('paymentOptions', $paymentOptions)
            ->with('hasDelivery', $hasDelivery)
            ->with('hasPickup', $hasPickup);
    }
}