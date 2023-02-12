<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'sometimes|integer|exists:products,id',
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'style' => 'required|string',
            'brand' => 'required|string',
            'product_type' => 'required|string|max:255',
            'shipping_price' => 'required|integer',
            'note' => 'nullable|string',
        ];
    }
}
