<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required|unique:products',
            'category_id' => 'required',
            'brand_id' => 'required',
            'description' => 'required',
            'image' => 'image|required|mimes:jpeg,png,jpg',
            'promotion_price' => 'required|numeric',
            'original_price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ];
    }
}
