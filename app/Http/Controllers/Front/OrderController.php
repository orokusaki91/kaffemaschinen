<?php

namespace App\Http\Controllers\Front;

use DB;
use PDF;
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

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\Details;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\ShippingAddress;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;

class OrderController extends Controller
{
	private $_api_context;

	public function __construct()
	{
		$paypal_conf = config()->get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential(
			$paypal_conf['client_id'],
			$paypal_conf['secret']
		));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}

	public function place(Request $request)
	{
		if (Auth::check()) {
			$user = Auth::user();
		} elseif(Session::has('guest_user')) {
			$user = Session::get('guest_user');
		} else {
			return redirect()->route('checkout.index');
		}

		$cartItems = Session::get('cart');

		$address = $user->getBillingAddress();
		$shippingAddress = $user->getShippingAddress();
		$shipping = Session::get('subtotal') < 100 ? Session::get('shipping') : 0;
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

            $paypalItem = new Item();
			$paypalItem->setName($item['name'])
				    ->setCurrency('CHF')
				    ->setQuantity($item['qty'])
				    ->setSku($item['id'])
				    ->setPrice($item['price']);

		    $items[] = $paypalItem;
        }

        $paypalDiscount = Session::get('discount');

        $discount = new Item();
		$discount->setName('Rabatt')
			    ->setCurrency('CHF')
			    ->setQuantity(1)
			    ->setPrice("-{$paypalDiscount}");

	    $items[] = $discount;

		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$paypalAddress = isset($shippingAddress) ? $shippingAddress : $address;

		$shipping_address = new ShippingAddress();
		$shipping_address->setCity($paypalAddress->city);
		$shipping_address->setCountryCode('CH');
		$shipping_address->setPostalCode($paypalAddress->postcode);
		$shipping_address->setLine1($paypalAddress->address1);
		$shipping_address->setState($paypalAddress->state);
		$shipping_address->setRecipientName($paypalAddress->first_name . ' ' . $paypalAddress->last_name);

		$itemList = new ItemList();
		$itemList->setItems($items)
				->setShippingAddress($shipping_address);

		$details = new Details();
		$details->setShipping($shipping)
		    ->setSubtotal(Session::get('paypalSubtotal'));

		$amount = new Amount();
		$amount->setCurrency("CHF")
		    	->setTotal(Session::get('total'))
		    	->setDetails($details);

		$transaction = new Transaction();
		$transaction->setItemList($itemList)
					->setAmount($amount);

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl(url('payment_status'))
    				->setCancelUrl(url('payment_status'));

    	$payment = new Payment();
		$payment->setIntent("sale")
		    	->setPayer($payer)
		    	->setRedirectUrls($redirectUrls)
		    	->setTransactions(array($transaction));

		try {
		    $payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (config()->get('app.debug')) {
				Session::flash('error', 'Bezahlung fehlgeschlagen. Verbindungszeitüberschreitung.');
				return redirect('/');
			} else {
				Session::flash('error', 'Bezahlung fehlgeschlagen. Bitte versuche es erneut.');
				return redirect('/');
			}
		}

		foreach ($payment->getLinks() as $link) {
			if ($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}

		Session::put('paypal_payment_id', $payment->getId());
		Session::put('user', $user);
		Session::put('deliverySyncedDataProducts', $deliverySyncedDataProducts);
		Session::put('deliverySyncedDataPackages', $deliverySyncedDataPackages);
		Session::put('address', $address);
		Session::put('shippingAddress', $shippingAddress);

		if (isset($redirect_url)) {
			return redirect()->away($redirect_url);
		}

		Session::flash('error', 'Bezahlung fehlgeschlagen. Bitte versuche es erneut.');
		return redirect('/');
	}

	public function login()
	{
		if (Session::has('cart') && Session::get('cart')->count() > 0) {
			if (Auth::check() || Session::has('guest_user')) {
				return redirect()->route('order.address');
			}
		} else {
			return redirect()->route('cart.view');
		}

		return view('front.order.login');
	}

	public function postLogin(Request $request) {
		if (Session::has('cart') && Session::get('cart')->count() > 0) {
			if (Auth::check() || Session::has('guest_user')) {
				return redirect()->route('order.address');
			}
		} else {
			return redirect()->route('cart.view');
		}

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
		if (Auth::check()) {
			if (Session::has('cart') && Session::get('cart')->count() > 0) {
				return redirect()->route('order.address');
			} else {
				return redirect()->route('cart.view');
			}
		}

		return view('front.order.register');
	}

	public function showGuestAddressForm()
	{
		if (Auth::check()) {
			if (Session::has('cart') && Session::get('cart')->count() > 0) {
				return redirect()->route('order.address');
			} else {
				return redirect()->route('cart.view');
			}
		}
		return view('front.order.guest_address');
	}

	public function postGuestAddressForm(Request $request)
	{
		if (Auth::check()) {
			if (Session::has('cart') && Session::get('cart')->count() > 0) {
				return redirect()->route('order.address');
			} else {
				return redirect()->route('cart.view');
			}
		}

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

        Session::put('guest_user', $user);

        $address = Address::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'type' => 'BILLING',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address1' => $request->address,
            'postcode' => $request->zip,
            'city' => $request->city,
            'phone' => $request->phone,
        ]);

        $user->addresses()->save($address);

        $address = Address::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'type' => 'Shipping',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address1' => $request->address,
            'postcode' => $request->zip,
            'city' => $request->city,
            'phone' => $request->phone,
        ]);

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
		if (Session::has('cart') && Session::get('cart')->count() > 0) {
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

		$billingAddress = $user->getBillingAddress();
		$shippingAddress = $user->getShippingAddress();

		return view('front.order.address', compact('user', 'billingAddress', 'shippingAddress'));
	}

	public function editAddress($type)
	{
		if (Auth::check()) {
        	$user = Auth::user();
		} else if (Session::has('guest_user')) {
            $user = Session::get('guest_user');
		}

		if (Session::has('cart') && Session::get('cart')->count() > 0 && $user) {
			if ($type == 'billing') {
				$address = $user->getBillingAddress();
			} else {
				$address = $user->getShippingAddress();
	        }
		} else {
        	return redirect()->route('order.address');
        }

		return view('front.order.edit_address', compact('user', 'address'));
	}

	public function updateAddress(Request $request, $type)
	{
		if (Auth::check()) {
        	$user = Auth::user();
		} else if (Session::has('guest_user')) {
            $user = Session::get('guest_user');
		}

		if ($user) {
			if ($type == 'billing') {
				$address = $user->getBillingAddress();
			} else {
				$address = $user->getShippingAddress();
	        }
		} else {
        	return redirect()->route('order.address');
        }

        $this->validate($request, [
            'title' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        $address->type = strtoupper($request->type);
        $address->title = $request->title;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->address1 = $request->address;
        $address->postcode = $request->postcode;
        $address->city = $request->city;
        $address->phone = $request->phone;

        $user->addresses()->save($address);

        return redirect()->route('order.address');
	}

	public function getPdf()
	{
        $pdf = PDF::loadView('front.emails.orderPDF');
        return $pdf->stream();
        // return view('front.emails.orderPDF');
	}

	public function getPaymentStatus(Request $request)
	{
		$payment_id = Session::get('paypal_payment_id');
		Session::forget('paypal_payment_id');

		if (empty($request->PayerID) || empty($request->token)) {
			Session::flash('error', 'Bezahlung fehlgeschlagen. Bitte versuche es erneut.');
			return redirect('/');
		}

		DB::beginTransaction();

		try {
			$orders = [];
			$orderForDelivery = new Order;
			$orderForDelivery->user_id = Session::get('user')->id;
			$orderForDelivery->billing_address_id = Session::get('address')->id;
			$orderForDelivery->shipping_address_id = Session::get('shippingAddress')->id;
			$orderForDelivery->payment_option = 'Lieferung';
			$orderForDelivery->order_status_id = 1;
			$orderForDelivery->total_amount = Session::get('total');
			$orderForDelivery->tax_25 = Session::get('totalTax25');
			$orderForDelivery->tax_77 = Session::get('totalTax77');
			$orderForDelivery->save();

			$orderForDelivery->products()->sync(Session::get('deliverySyncedDataProducts'), false);
			$orderForDelivery->packages()->sync(Session::get('deliverySyncedDataPackages'), false);
			$orderForDelivery->setSubtotal(Session::get('subtotal'));
			// 1. set orders
			$orders['deliveryOrder'] = $orderForDelivery;

			// 2. execute the payment
			$payment = Payment::get($payment_id, $this->_api_context);
			$execution = new PaymentExecution();
			$execution->setPayerId($request->PayerID);
			$result = $payment->execute($execution, $this->_api_context);

			} catch (\Exception $e) {
				DB::rollback();
				return redirect('/')->with('error', 'Etwas ist schief gelaufen. Bitte versuchen Sie es erneut.');
			}

		if ($result->getState() == 'approved') {
			// 3. commit the transaction
			DB::commit();
			// send email
			dispatch(new SendOrderMail($orders, Session::get('user')));
			// remove the pdf
        	unlink(Session::get('pdf_path'));
        	// remove all sessions
			Session::forget('user');
			Session::forget('cart');
			Session::forget('deliverySyncedDataProducts');
			Session::forget('deliverySyncedDataPackages');
			Session::forget('address');
			Session::forget('shippingAddress');
			Session::forget('pdf_path');
			Session::flash('order_made', __('front.order_successfully_made'));
			return redirect('/');
		}

		DB::rollback();

		Session::flash('error', 'Bezahlung fehlgeschlagen. Bitte versuche es erneut.');
		return redirect('/');		
	}
}
