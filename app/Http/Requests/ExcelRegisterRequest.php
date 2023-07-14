<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelRegisterRequest extends FormRequest
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
            
            'file' => 'required|mimes:xls,xlsx',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => "Excel file is not choosen!",
            'file.mimes' => "File must be Excel File!",

        ];
    }
}
