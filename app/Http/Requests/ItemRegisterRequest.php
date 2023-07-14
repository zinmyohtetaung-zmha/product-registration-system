<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRegisterRequest extends FormRequest
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



    /**
     * to validation items registers
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return
     */
    public function rules()
    {
        return [
            //
            'item_id' => 'required',
            'item_code' => 'required|max:50',
            'item_name' => 'required|max:100',
            'selectbox' => 'required',
            'safety_stock' => 'required',
            'received_date' => 'required',
            'filename' => 'mimes:jpeg,png,jpg' 
        ];
    }

    //custom message validation
    public function messages()
    {

        return [
            'item_id.required' => 'Item ID is Required',
            'item_code.required' => 'Item Code is Required',
            'item_code.max' => 'Item Code shoult not be more than 50 characters!',
            'item_name.required' => 'Item Name is Required',
            'item_name.max' => 'Item Name shoult not be more than 100 characters!',
            'selectbox.required' => 'Category Name is Required',
            'safety_stock.required' => 'Safety Stock field is Required',
            'received_date.required' => 'Received Date is Required',
            'filename.mimes' => 'Allow file type jpeg,png,jpg'

        ];
    }
}
