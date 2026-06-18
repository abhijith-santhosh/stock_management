<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockMovementRequest extends FormRequest
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
        'product_id' => 'required|exists:products,id',
        'movement_type' => 'required|in:sale,purchase,sale_return,purchase_return,adjustment',
        'quantity' => 'required|integer|min:1',
        'reference_no' => 'required|unique:stock_movements,reference_no',
        'notes' => 'nullable|string'
    ];
}
}
