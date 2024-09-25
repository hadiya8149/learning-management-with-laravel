<?php

namespace App\Http\Requests;

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
        // check if user is admin
        return true;
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
                'id'=>'required|exists:students,id',
                
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
                'id'=>'required|exists:students,id',
            ];
        }
    }
    public function messages(){
        return [
            'name.required'=>'Name field is required.',
            'email.required'=>'Email field is required.',
            'email.unique'=>'Email address not available.'
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
