<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use ILluminate\Support\Facades\Auth;

class AssignQuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user->can('user can assign quiz');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'quiz_id'=>'required|exits:quizzes,id',
            'email'=>'required|exists:users,email'
        ];
    }
    public function messages()
    {
        return [
            'quiz_id.required'=>'Quiz id  is required',
            'quiz_id.exists'=> 'Invalid quiz id',
            'email.required'=>'Email  is required',
            'email.exists'=>'Invalid email address',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $this->validator->errors();
        $response =  response()->json([
            'validation errors'=>$errors,
        ]);
        throw new HttpResponseException($response);
    }
}
