<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class SubmitQuizAttemptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id'=>'required|exists:assigned_quizzes,id',
            'student_id'=>'required|exists:students,id',

            'answers'=>'required|json',
            'video'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'quiz_id.exists'=>'invalid quiz id',
            'student_id.exists'=>'invalid student id',
            'answers'=>'answers must be json object'
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        $errors = $this->validator->errors();

        $response =  response()->json([
            'errors'=>$errors
        ], 400);
        throw new HttpResponseException($response);
    }

}
