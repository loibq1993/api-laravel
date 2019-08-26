<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'suppliers|required|max:100|string',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:20',
            'logo' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'address' => 'string|required'
        ];
    }
}
