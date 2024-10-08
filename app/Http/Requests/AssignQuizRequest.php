<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use ILluminate\Support\Facades\Auth;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AssignQuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('user can assign quiz');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'quiz_id'=>'required|exists:quizzes,id',
            'student_id'=>'required|exists:students,id'
        ];
    }
    public function messages()
    {
        return [
            'quiz_id.required'=>'Quiz id  is required',
            'quiz_id.exists'=> 'Invalid quiz id',
            'student_id.required'=>'id  is required',
            'student_id.exists'=>'Invalid student id',
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
