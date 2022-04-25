<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => 'filled',
            'category_id' => 'filled',
            'brand_id' => 'filled',
            'description' => 'filled',
            'image' => 'filled|image|mimes:jpeg,png,jpg',
            'promotion_price' => 'filled',
            'original_price' => 'filled',
            'quantity' => 'filled',
        ];
    }
}