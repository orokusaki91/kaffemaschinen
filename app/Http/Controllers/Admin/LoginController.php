<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends AdminController
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

    // where to redirect users after login/registration
    protected $redirectTo = '/admin';

    //create a new controller instance
    public function __construct()
    {
        $this->middleware('admin.guest', ['except' => 'logout']);
    }

    public function loginForm()
    {
        return view('admin.user.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }
}