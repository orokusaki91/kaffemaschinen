<?php

namespace App\Http\Controllers\Front;

use DB;
use Auth;
use Session;
use App\Jobs\SendOrderMail;
use App\Models\Database\Product;
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
		if (Session::has('guest_user')) {
			$user = Session::get('guest_user');
		} elseif(Auth()->check()) {
			$user = Auth::user();
		} else {
			return redirect()->route('checkout.index');
		}

		$cartItems = Session::get('cart');

		DB::beginTransaction();

		$address = $user->getBillingAddress();
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

		try {
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
		} catch (Exception $e) {
            DB::rollback();

			return response()->json([
				'status' => 'Etwas ist schief gelaufen. Bitte versuchen Sie es erneut.'
			]);
		}

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

			dispatch(new SendOrderMail($orders, $user));

			DB::commit();
			Session::forget('cart');
			Session::flash('order_made', __('front.order_successfully_made'));
	        
	        return redirect()->route('home');

		} catch (\Exception $e) {
            DB::rollback();

			return response()->json([
				'status' => $e->getMessage()
			], 422);
		}
	}

	public function login()
	{
		if (Auth::check() || Session::has('guest_user')) {
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
        $user->addresses()->save($address);

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
		} elseif(Auth()->check()) {
			$user = Auth::user();
		} else {
			return redirect()->route('cart.view');
		}

		$billingAddress = $user->getBillingAddress();
		$shippingAddress = $user->getShippingAddress();

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
		} elseif ($type == 'shipping') {
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
		} elseif ($type == 'shipping') {
			$address = $user->getShippingAddress();
        } else {
        	return redirect()->route('order.address');
        }

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

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
