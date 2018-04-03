<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserConfirmation;
use App\Models\Database\Popup;
use App\Models\Database\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/my-account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        /*
        $user = User::all()->where('id', '1')->first();
        Mail::to('dragantic91@gmail.com')->send(new UserConfirmation($user));

        $checkoutUrl = route('home');
        $this->redirectTo = $checkoutUrl;
        */


        $this->middleware('front.guest', ['except' => 'logout']);

        $url = URL::previous();
        $checkoutUrl = route('checkout.index');

        if ($url == $checkoutUrl) {
            $this->redirectTo = $checkoutUrl;
        }

    }

    public function authenticate(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = (Input::has('remember_me')) ? true : false;

        if (Auth::attempt(['email' => $email, 'password' => $password, 'confirmed' => 1], $remember)) {
            $url = URL::previous();
            $checkoutUrl = route('checkout.index');

            if ($url == $checkoutUrl)
                return redirect($checkoutUrl);
            else
                return redirect($this->redirectPath());
        }
        else {
            $user = User::all()->where('email', $email)->first();
            if (count($user) != 1) {
                return redirect(route('login'))
                    ->with('status', 'Die Logindaten sind ungültig!' );
            }
            else {
                if ($user->confirmed == 1) {
                    return redirect(route('login'))
                        ->with('status', 'Falsches Passwort. Bitte versuchen Sie es erneut!' );
                }
                else {
                    return redirect(route('login'))
                        ->with('status', 'Benutzerkonto wurde noch nicht verifiziert. Bitte überprüfen Sie Ihre Mail.' );
                }
            }
        }

    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function showLoginForm()
    {
        return view('front.auth.login');
    }
}
