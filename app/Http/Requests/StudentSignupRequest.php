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

            'email'=>'required|email',
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'cnic'=>'required|digits:13',
            'date_of_birth'=>'required|date|before:2004-01-01|after:1970-01-01',
            'phone_number'=>'required|digits:12',
            'cv' => 'required|file|mimes:doc,pdf,csv,docx|max:'.$this->maxFileSize,
        ];
    }

    public function messages()
    {
        return [
          'first_name.string'=>'First Name should be a valid string',
          'last_name.string'=>'Last Name should be a valid string',
          'cnic.digits'=>'cnic should contain 13 digits',
          'phone_number.digits'=>'Phone number should contain 12 digits',
          'cv.mimes'=>'cv file format should be either doc,pdf,csv or docx',
          'cv.max'=>'File should be smaller than '.$this->maxFileSize. 'MB',

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
