<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginCheckRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => 'required|numeric',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => "Employee ID is required!",
            'employee_id.numeric' => "Invalid Employee ID!",
            'password.required' => "Password is required!",     
        ];
    }
}
