<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\Database\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forgotPassword()
    {
        return view('front.auth.forgot-password');
    }

    public function postForgotPassword(Request $request)
    {
        $user = User::whereEmail($request->email)->first();

        if (count($user) == 0) {
            return redirect()->back()
                ->with(['notificationText' => 'Der Reset-Code wurde an Ihre E-Mail gesendet.']);
        }

        $this->sendEmail($user, $user->token);

        return redirect()->back()
            ->with(['notificationText' => 'Der Reset-Code wurde an Ihre E-Mail gesendet.']);
    }

    private function sendEmail($user, $code)
    {
        Mail::send('front.emails.forgot-password', [
            'user' => $user,
            'code' => $code
        ], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello $user->first_name, reset your password.");
        });
    }

    public function resetPassword($email, $resetCode)
    {
        $user = User::whereEmail($email)->where('token', $resetCode)->first();

        if (count($user) == 0) {
            abort(404);
        }
        else {
            return view('front.auth.reset-password');
        }
    }

    public function postResetPassword(ResetPasswordRequest $request, $email, $resetCode)
    {
        $user = User::whereEmail($email)->where('token', $resetCode)->first();

        if (count($user) == 0) {
            abort(404);
        }
        elseif (count($user) == 1) {
            User::whereEmail($email)->where('token', $resetCode)
                    ->update(['password' => bcrypt($request['password'])
            ]);
            return redirect('/login')->with('notificationText', 'Bitte loggen Sie sich mit Ihrem neuen Passwort ein.');
        }
    }
}
