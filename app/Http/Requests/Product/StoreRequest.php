<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|decimal:0.0, 999999.999999',
            'currency_id' => 'required|exists:currencies,id',
            'tax_cost' => 'required|decimal:0.0, 999999.999999',
            'manufacturing_cost' => 'required|decimal:0.0, 999999.999999',
        ];
    }
}
