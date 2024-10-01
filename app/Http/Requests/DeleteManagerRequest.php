<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use ILluminate\Support\Facades\Auth;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class DeleteManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        return $user->can('user can delete user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id'=>'required|exists:managers,id'
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
