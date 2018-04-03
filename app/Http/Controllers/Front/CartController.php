<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Database\Product;
use App\Models\Database\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Stripe\{Charge, Customer};

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = (null === Session::get('cart')) ? Collection::make([]) : Session::get('cart');

        if ($request->get('type') == 'product') {
            $product = Product::where('id', '=', $request->get('id'))->first();
        } elseif ($request->get('type') == 'package') {
            $package = Package::where('id', '=', $request->get('id'))->first();
        }

        $qty = (null === $request->get('qty')) ? 1 : $request->get('qty');

        if ($request->get('type') == 'product') {
            if ($cart->has('product:'.$product->id)) {
                $item = $cart->pull('product:'.$product->id);
                $item['qty'] = $qty;
                $cart->put('product:'.$product->id, $item);
            } else {
                if ($product->discount == 1)
                    $price = $product->discount_price;
                else
                    $price = $product->price;

                $cart->put('product:'.$product->id, [
                    'id' => $product->id,
                    'qty' => $qty,
                    'price' => $price,
                    'image' => $product->image->smallUrl,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'delivery' => $product->delivery,
                    'pdv' => $product->pdv
                ]);
            }
        } elseif ($request->get('type') == 'package') {
            if ($cart->has('package:'.$package->id)) {
                $item = $cart->pull('package:'.$package->id);
                $item['qty'] = $qty;
                $cart->put('package:'.$package->id, $item);
            } else {
                $price = $package->price;

                $cart->put('package:'.$package->id, [
                    'id' => $package->id,
                    'qty' => $qty,
                    'price' => $price,
                    'image' => asset('front/assets/img/package-default.png'),
                    'name' => $package->name,
                    'pdv' => $package->pdv
                ]);
            }
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('notificationText', 'Der Artikel/Angebot wurde erfolgreich in den Warenkorb hinzugefügt!');
    }

    public function view()
    {
        $cartItems = Session::get('cart');

        $allProducts = Product::select('id')->get();
        $allPackages = Package::select('id')->get();

        if($cartItems) {
            $arr = [];
            foreach ($allProducts as $product) {
                foreach ($cartItems as $cartKey => $cartItem) {
                    $type = explode(':', $cartKey)[0];

                    if ($type == 'product') {
                        if ($product->id == $cartItem['id']) {
                            $arr['product:'.$cartItem['id']] = $cartItem;
                        }
                    }
                }
            }
            foreach ($allPackages as $package) {
                foreach ($cartItems as $cartKey => $cartItem) {
                    $type = explode(':', $cartKey)[0];

                    if ($type == 'package') {
                        if ($package->id == $cartItem['id']) {
                            $arr['package:'.$cartItem['id']] = $cartItem;
                        }
                    }
                }
            }
            $cartItems = $arr;
        }
        return view('front.cart.view')
            ->with('cartItems', $cartItems);
            
    }

    public function update(Request $request)
    {
        $cartData = Session::get('cart');
        $qty = $request->get('qty');

        if ($request->get('type') == 'product') {
            $product = Product::find(request('id'));

            if (!is_numeric($qty)) {
                $item = $cartData->pull('product:'.$request->get('id'));
                $item['qty'] = 1;
                $cartData->put('product:'.$request->get('id'), $item);
            } elseif ($qty == 0) {
                $cartData->pull('product:'.$request->get('id'));
            } else {
                $item = $cartData->pull('product:'.$request->get('id'));
                $item['qty'] = $qty;
                $cartData->put('product:'.$request->get('id'), $item);
            }
        } elseif ($request->get('type') == 'package') {
            $package = Package::find(request('id'));

            if (!is_numeric($qty)) {
                $item = $cartData->pull('package:'.$request->get('id'));
                $item['qty'] = 1;
                $cartData->put('package:'.$request->get('id'), $item);
            } elseif ($qty == 0) {
                $cartData->pull('package:'.$request->get('id'));
            } else {
                $item = $cartData->pull('package:'.$request->get('id'));
                $item['qty'] = $qty;
                $cartData->put('package:'.$request->get('id'), $item);
            }
        }

        Session::put('cart', $cartData);

        return JsonResponse::create(['status' => true, 'cart' => Session::get('cart')]);
    }

    public function updateDelivery(Request $request)
    {
        $cartData = Session::get('cart');
        $aDelivery = $request->input('delivery');
        if ($aDelivery == null) {
            $aDelivery = [];
        }
        $hasDelivery = false;
        $hasPickup = false;

        foreach ($cartData as $key => $item) {
            $type = explode(':', $key)[0];
            $pom = $cartData->pull($type.':'.$item['id']);
            $pom['for_delivery'] = true;
            $cartData->put($type.':'.$pom['id'], $pom);
            $hasDelivery = true;
        }


        Session::put('cart', $cartData);
        Session::put('hasDelivery', $hasDelivery);

        //return redirect()->back();
        return redirect('/checkout');
    }

    public function destroy($id, $type)
    {
        $cartData = Session::get('cart');
        $cartData->pull($type.':'.$id);

        Session::put('cart', $cartData);

        return redirect()->back();
    }
}