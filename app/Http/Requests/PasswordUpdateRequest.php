<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Password;

class PasswordUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // authorize if the token matches against the email
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if($this->routeIs('password.set')){

            return [
            'token'=>'required', // token exists in database
            'email'=>'required|exists:users,email',
            'password_confirmation'=>'required',
            'password'=>['required', 'confirmed', Password::min(8),'max:11']
            ];
        }
        if($this->routeIs('password.reset')){

            return [
            'id'=>'required'
            ];
        }
    }
    public function messages(){
        return [
        'token.required'=>'Password reset token is required',
        'email.required'=>"Email field can't be empty",
        'email.exists'=>"Account not found",
        'token.exists'=>"Invalid token",
        'password.required'=>'Password field is required',
        'password_confirmation.required'=>'password confirmation field is required',
        'password.confirmed'=>"Passwords donot match",
        'password.max'=>"Password length exceeds max length of 11 characters"
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $this->validator->errors();

        $response =  response()->json([
            'validation errors'=>$errors
        ]);
        throw new HttpResponseException($response);
    }
}
