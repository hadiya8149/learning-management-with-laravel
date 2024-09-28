<?php

namespace App\Http\Requests;
use ILluminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // check if user has permission to add user
        $user = Auth::user();
        return $user->hasPermissionTo('user can add user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if($this->routeIs('add.student')){

            return [
                'email'=>'required|exists:students,email|unique:users,email',
            ];
        }
        if($this->routeIs('add.manager')){

            return [
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            ];
        }
        if($this->routeIs('reject.student')){
            return [
                'email'=>'required|exists:students,email',
            ];
        }
    }
    public function messages(){
        return [
            'name.required'=>'Name field is required.',
            'email.required'=>'Email field is required.',
            'email.unique'=>'Account already exists.'
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        $errors = $this->validator->errors();

        $response =  response()->json([
            'errors'=>$errors
        ]);
        throw new HttpResponseException($response);
    }
}
