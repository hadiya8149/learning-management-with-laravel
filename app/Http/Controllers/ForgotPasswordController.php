<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\PasswordReset;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use JWTAuth;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

use App\Models\User;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Helpers\Helpers;

class ForgotPasswordController extends Controller
{


    // Override the method that handles a successful reset link response 'where to put this?
    // protected function sendResetLinkResponse(Request $request, $response)
    // {
    //     return response()->json([
    //         'message' => trans($response)
    //     ], 200);
    // }

    public function submitForgotPasswordForm(ForgotPasswordRequest $request) #for sending reset password link
    {
        $validatedData = $request->validated();
        $email = $validatedData['email'];
        // sends a pasword reset link to the provided email
        
        $status = Password::sendResetLink(
           ["email"=>$email]
        );
        
        return $status === Password::RESET_LINK_SENT
        ? Helpers::sendSuccessResponse(200, 'Success')
        :Helpers::sendFailureResponse(401, 'Invalid email')
       ;
    }
}

