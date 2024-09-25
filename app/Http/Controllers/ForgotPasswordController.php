<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\PasswordReset;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

use App\Models\User;
use App\Http\Requests\ForgotPasswordRequest;
class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api',[ "except"=>['index','submitForgotPasswordForm', 'submitResetPasswordForm']]);
    }

    public function submitForgotPasswordForm(ForgotPasswordRequest $request) #for sending reset password link
    {
        $validatedData = $request->validated();
        $email = $validatedData['email'];
        // sends a pasword reset link to the provided email
        $status = Password::sendResetLink(
           ["email"=>$email]
        );
       
        return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswrodForm() #web function not needed
    {
    }
    
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $user = User::query()->where('email', $request->email);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ]);
     // setremembertoekn
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

}

