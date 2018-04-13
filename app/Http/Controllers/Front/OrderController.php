<?php

namespace App\Http\Controllers\Front;

use App\Jobs\SendOrderMail;
use App\Models\Database\Product;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;
use App\Models\Database\User;
use App\Models\Database\Order;
use App\Models\Database\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Jobs\SendVerificationEmail;
use Stripe\{Stripe, Charge, Customer};

class OrderController extends Controller
{
	public function place(Request $request)
	{
		if (!auth()->check()) {
			$this->validate($request, [
				'billing_terms_and_conditions' => 'required',
				'billing_first_name' => 'required',
				'billing_last_name' => 'required',
				'billing_address' => 'required',
				'billing_postcode' => 'required',
				'billing_city' => 'required',
				'email' => 'required|email|unique:users',
				'is_company' => 'required',
                'company_name' =>'required_if:is_company,1',
				'password' => 'required|confirmed',
				'password_confirmation' => 'required',
				'shipping_first_name' => 'required_with:use_different_shipping_address',
				'shipping_last_name' => 'required_with:use_different_shipping_address',
				'shipping_address' => 'required_with:use_different_shipping_address',
				'shipping_postcode' => 'required_with:use_different_shipping_address',
				'shipping_city' => 'required_with:use_different_shipping_address',
			], ['billing_agree' => __('validation.accepted')]);
		} else {
			$this->validate($request, [
				'billing_terms_and_conditions' => 'required',
				'shipping_first_name' => 'required_with:use_different_shipping_address',
				'shipping_last_name' => 'required_with:use_different_shipping_address',
				'shipping_address' => 'required_with:use_different_shipping_address',
				'shipping_postcode' => 'required_with:use_different_shipping_address',
				'shipping_city' => 'required_with:use_different_shipping_address',
			]);
		}

		$cartItems = Session::get('cart');

		DB::transaction(function () use ($cartItems) {
			if (!auth()->check()) {
				$user = new User;
                $user->title = "Her";
				$user->first_name = request('billing_first_name');
				$user->last_name = request('billing_last_name');
				$user->is_company = request('is_company');
				$user->company_name = request('company_name');
				$user->phone = request('billing_phone');
				$user->email = request('email');
				$user->password = bcrypt(request('password'));
				$user->token = base64_encode(request('email'));
				$user->save();

                event(new Registered($user));
                dispatch(new SendVerificationEmail($user));

				$address = new Address;
				$address->type = 'BILLING';
				$address->first_name = request('billing_first_name');
				$address->last_name = request('billing_last_name');
				$address->address1 = request('billing_address');
				$address->postcode = request('billing_postcode');
				$address->city = request('billing_city');
				$address->phone = request('billing_phone');

				$user->addresses()->save($address);
			} else {
				$user = auth()->user();
				$address = $user->addresses()->where('type', 'BILLING')->first();
			}

			if (request('use_different_shipping_address') == 'on') {
				$shippingAddress = new Address;
				$shippingAddress->type = 'SHIPPING';
				$shippingAddress->first_name = request('shipping_first_name');
				$shippingAddress->last_name = request('shipping_last_name');
				$shippingAddress->address1 = request('shipping_address');
				$shippingAddress->postcode = request('shipping_postcode');
				$shippingAddress->city = request('shipping_city');
				$shippingAddress->phone = request('shipping_phone');

				$user->addresses()->save($shippingAddress);
			}

			//$pickupSyncedData = [];

			$deliverySyncedDataProducts = [];
			$deliverySyncedDataPackages = [];

			foreach ($cartItems as $id => $item) {
				$type = explode(':', $id)[0];
				$itemId = explode(':', $id)[1];
				if ($type == 'product') {
                    if (array_key_exists('for_delivery', $item)) {
                        if ($item['for_delivery'] === true) {
                            $cartItemsForDelivery[] = $item;
                            $deliverySyncedDataProducts[$itemId] = [
                                'qty' => $item['qty'],
                                'price' => $item['price'],
                            ];
                        }
                    }
                } elseif ($type == 'package') {
                    if (array_key_exists('for_delivery', $item)) {
                        if ($item['for_delivery'] === true) {
                            $cartItemsForDelivery[] = $item;
                            $deliverySyncedDataPackages[$itemId] = [
                                'qty' => $item['qty'],
                                'price' => $item['price'],
                            ];
                        }
                    }
                }
            }
//					else if ($item['for_delivery'] === false) {
//						$cartItemsForPickup[] = $item;
//						$pickupSyncedData[$id] = [
//							'qty' => $item['qty'],
//							'price' => $item['price'],
//							'tax_amount' => $item['delivery_price']
//						];
//					}

			$orders = [];
			if (!empty($cartItemsForDelivery)) {
				$orderForDelivery = new Order;
				$orderForDelivery->user_id = $user->id;
				$orderForDelivery->billing_address_id = $address->id;
				$orderForDelivery->shipping_address_id = isset($shippingAddress) ? $shippingAddress->id : null;
				$orderForDelivery->payment_option = 'Lieferung';
				$orderForDelivery->order_status_id = 1;
				$orderForDelivery->total_amount = Session::get('total');
				$orderForDelivery->tax_25 = Session::get('totalTax25');
				$orderForDelivery->tax_77 = Session::get('totalTax77');
				$orderForDelivery->save();

				$orderForDelivery->products()->sync($deliverySyncedDataProducts, false);
				$orderForDelivery->packages()->sync($deliverySyncedDataPackages, false);

				$orders['deliveryOrder'] = $orderForDelivery;
			}

//			if (!empty($cartItemsForPickup)) {
//				$orderForPickup = new Order;
//				$orderForPickup->user_id = $user->id;
//				$orderForPickup->billing_address_id = $address->id;
//				$orderForPickup->shipping_address_id = isset($shippingAddress) ? $shippingAddress->id : null;
//				$orderForPickup->payment_option = 'Abholung';
//				$orderForPickup->order_status_id = 1;
//				$orderForPickup->total_amount = Session::get('pickupTotal');
//				$orderForPickup->save();
//
//				$orderForPickup->products()->sync($pickupSyncedData, false);
//
//                $orders['pickupOrder'] = $orderForPickup;
//			}

			Stripe::setApiKey(config('stripe.secret_key'));

			try {
				$customer = Customer::create([
					'email' => request('stripeEmail'),
					'source' => request('stripeToken'),
				]);
				$user->stripe_id = $customer->id;
				$user->save();

				Charge::create([
					'customer' => $user->stripe_id,
					'amount' => Session::get('total') * 100,
					'currency' => 'chf',
				]);

//				foreach ($cartItems as $key => $data){
//				    $product = Product::findorfail($data['id']);
//                    $product->qty -= $data['qty'];
//                    $product->update();
//                }

                dispatch(new SendOrderMail($orders));

				Session::forget('cart');
				Session::flash('order_made', __('front.order_successfully_made'));

			} catch (\Exception $e) {
				return response()->json([
					'status' => $e->getMessage()
				], 422);
			}
		});
	}

	public function login()
	{
		if (Auth::check()) {
			return redirect()->route('order.address');
		}

		return view('front.order.login');
	}

	public function postLogin(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = (Input::has('remember_me')) ? true : false;

        if (Auth::attempt(['email' => $email, 'password' => $password, 'confirmed' => 1], $remember)) {
            return redirect()->route('order.address');
        } else {
            $user = User::all()->where('email', $email)->first();
            if (count($user) != 1) {
                return redirect(route('order.login'))
                    ->with('status', 'Die Logindaten sind ungültig!' );
            } else {
                if ($user->confirmed == 1) {
                    return redirect(route('order.login'))
                        ->with('status', 'Falsches Passwort. Bitte versuchen Sie es erneut!' );
                } else {
                    return redirect(route('order.login'))
                        ->with('status', 'Benutzerkonto wurde noch nicht verifiziert. Bitte überprüfen Sie Ihre Mail.' );
                }
            }
        }
	}

	public function register()
	{
		return view('front.order.register');
	}

	public function showGuestAddressForm()
	{
		return view('front.order.guest_address');
	}

	public function postGuestAddressForm(Request $request)
	{
		$this->validate($request, [
            'is_company' => 'required',
            'title' => 'required',
			'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'address' => 'required',
            'title' => 'required',
            'city' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'zip' => 'required',
            'phone' => 'required',
		]);

		$user = User::create([
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'confirmed' => 1,
            'is_company' => $request->is_company,
            'company_name' => $request->company_name,
            'token' => base64_encode($request->email),
        ]);

        $user->save();

        $address = Address::create([
            'user_id' => $user->id,
            'type' => 'BILLING',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address1' => $request->address,
            'postcode' => $request->zip,
            'city' => $request->city,
            'phone' => $request->phone,
        ]);

        Session::put('guest_user', $user);
        Session::put('guest_address', $address);

        if ($request->subscribe){
            $email = $request->email;
            $check = Subscriber::where('email', '=', $email)->first();

            if (count($check) == 0) {
                Subscriber::create(['email' => $email]);
            }
        }

        return redirect()->route('order.address');
	}

	public function showOrderAddress()
	{
		if (Session::has('guest_user')) {
			$user = Session::get('guest_user');
		} else {
			$user = Auth::user();
		}

		if (Session::has('guest_address')) {
			$billingAddress = Session::get('guest_address');
			$shippingAddress = Session::get('guest_address');
        } else {
			$billingAddress = $user->getBillingAddress();
			$shippingAddress = $user->getShippingAddress();
        }

		return view('front.order.address', compact('user', 'billingAddress', 'shippingAddress'));
	}

	public function editAddress($type)
	{
		if (Session::has('guest_user')) {
            $user = Session::get('guest_user');
        } else {
        	$user = Auth::user();
        }

        if ($type == 'billing') {
			$address = $user->getBillingAddress();
        } else if ($type == 'shipping') {
			$address = $user->getShippingAddress();
        } else {
        	return redirect()->route('order.address');
        }

		return view('front.order.edit_address', compact('user', 'address'));
	}

	public function updateAddress(Request $request, $type)
	{
		if (Session::has('guest_user')) {
            $user = Session::get('guest_user');
        } else {
        	$user = Auth::user();
        }

        if ($type == 'billing') {
			$address = $user->getBillingAddress();

			$this->validate($request, [
	            'first_name' => 'required',
	            'last_name' => 'required',
	            'address' => 'required',
	            'city' => 'required',
	            'postcode' => 'required',
	            'phone' => 'required',
	        ]);
        } else if ($type == 'shipping') {
			$address = $user->getShippingAddress();

			$this->validate($request, [
	            'first_name' => 'required',
	            'last_name' => 'required',
	            'address' => 'required',
	            'city' => 'required',
	            'postcode' => 'required',
	        ]);
        } else {
        	return redirect()->route('order.address');
        }

        $address->type = strtoupper($request->type);
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->address1 = $request->address;
        $address->postcode = $request->postcode;
        $address->city = $request->city;
        $address->phone = $request->phone;

        $user->addresses()->save($address);

        return redirect()->route('order.address');
	}
}
