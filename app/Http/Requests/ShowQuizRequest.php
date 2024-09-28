<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use ILluminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
class ShowQuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // develop logic to assign this permission only when a user has been assigned quiz or not??? 
        $user = Auth::user();
        if($user->hasRole('Student')){
           return $user->can('user can view assigned quiz'); 
        }
        else if ($user->hasRole(['Manager', 'Super Admin']))
       {
        return true;
       }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id'=>'required|exists:quizzes,id'
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
