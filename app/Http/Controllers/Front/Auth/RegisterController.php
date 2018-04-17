<?php

namespace App\Http\Controllers\Front\Auth;

use Session;
use Illuminate\Support\Facades\URL;
use App\Events\UserRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Models\Database\Address;
use App\Models\Database\Subscriber;
use App\Models\Database\User;
use Bestmomo\LaravelEmailConfirmation\Traits\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Jobs\SendVerificationEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/my-account';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
        $this->middleware('front.guest');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'is_company' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'address' => 'required',
            'title' => 'required',
            'city' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'zip' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

        $user->confirmed = 1;
        $user->is_company = $request->is_company;
        $user->company_name = $request->company_name;
        $user->save();

        if ($request->subscribe){
            $email = $request->email;
            $check = Subscriber::where('email', '=', $email)->first();

            if (count($check) == 0) {
                Subscriber::create(['email' => $email]);
            }
        }

        Auth::login($user);

        if (Session::has('cart') && Session::get('cart')->count() > 0) {
            return redirect()->route('order.address');
        } else {
            return redirect('/')->with('registration_success', 'Registrierung erfolgreich');
        }

    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'title' => $data['title'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => base64_encode($data['email']),
        ]);

        Address::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'type' => 'BILLING',
            'first_name' => $data['first_name'],
            'last_name' =>$data['last_name'],
            'address1' => $data['address'],
            'postcode' => $data['zip'],
            'city' => $data['city'],
            'phone' => $data['phone'],
        ]);

        Address::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'type' => 'SHIPPING',
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address1' => $data['address'],
            'postcode' => $data['zip'],
            'city' => $data['city'],
            'phone' => $data['phone'],
        ]);

        return $user;
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function showRegistrationForm()
    {
        return view('front.auth.register');
    }

    public function verify($token)
    {
        $user = User::where('token', $token)->first();

        if($user->save()){
            return view('front.auth.emailconfirm', ['user' => $user]);
        }
    }
}