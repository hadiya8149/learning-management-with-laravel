<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class StudentSignupRequest extends FormRequest
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
    protected $maxFileSize=1024*3;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'email'=>'required|email|unique:students,email',
            'name'=>'required',
            'phone_number'=>'required|digits:12',
            'cv' => 'required|file|mimes:doc,pdf,csv,docx|max:'.$this->maxFileSize,
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'email field is required',
            'name.required'=>'name field is required',
          'phone_number.digits'=>'Phone number should contain 12 digits',
          'cv.mimes'=>'cv file format should be either doc,pdf,csv or docx',
          'cv.max'=>'File should be smaller than '.$this->maxFileSize. 'MB',

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
