<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class   StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:products|max:255',
            'image' => 'required|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'image.required'  => 'Ảnh sản phẩm không được để trống',
            'name.unique' => 'Đã có sản phẩm cùng tên trong dữ liệu',
            'image.image' => 'Ảnh phải là định dạng jpeg, png, jpg, gif, svg',
            'image.mimes' => 'Ảnh phải là định dạng jpeg, png, jpg, gif, svg',
            'image.max' => 'Dung lượng ảnh phải nhỏ hơn 2MB',
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
                'status' => 422,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
