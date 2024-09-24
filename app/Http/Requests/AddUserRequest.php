<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'email'=>'required|email|unique',
            ];
        }
    }
}
