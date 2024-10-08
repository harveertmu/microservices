<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateProductDetailsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to make this request
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id', // Ensure product_id exists in products table
            'description' => 'nullable|string', // Description can be null or a string
            'color' => 'nullable|string', // Color can be null or a string
            'size' => 'nullable|string', // Size can be null or a string
            'weight' => 'nullable|numeric', // Weight can be null or a numeric value
        ];
    }
}
