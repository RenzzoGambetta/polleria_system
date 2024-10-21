<?php

namespace App\Http\Requests\inventory;

use Illuminate\Foundation\Http\FormRequest;

class inventoryReceiptRequest extends FormRequest
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
            'voucher_type_id' => 'integer|required',
            'voucher_serie' => 'string|required|max:4',
            'correlative_numer' => 'string|required|digits:8',
            'supplier_ruc' => 'string|required',
            'issuance_date' => 'date|required',
            'expiration_date' => 'date|nullable|after_or_equal:issuance_date',
            'total_amount' => 'decimal:2|required|min:0',
            'payment_type' => 'required|in:contado,credito',
            'commentary' => 'string|max:255',
            'supply_ids' => 'required|array',
            'supply_ids.*' => 'integer|exists:supplies,id',
            'prices' => 'required|array',
            'prices.*' => 'decimal:2|min:0',
            'quantities' => 'required|array',
            'quantities.*' => 'numeric|min:1',
            'total_prices' => 'required|array',
            'total_prices.*' => 'decimal:2|min:0',
            'notes' => 'array',
            'notes.*' => 'string|max:255',
        ];
    }
}
