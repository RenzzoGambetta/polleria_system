<?php

namespace App\Http\Requests\inventory;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class inventoryReceiptRequest extends BaseRequest
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
            'voucher_type_id' => 'required|integer',
            'voucher_serie' => 'required|string|max:5',
            'correlative_numer' => 'required|string',
            'supplier_id' => 'required|integer',
            'issuance_date' => 'required|date',
            'expiration_date' => 'date|after_or_equal:issuance_date|nullable',
            'payment_type' => 'required|in:contado,credito',
            'commentary' => 'string|max:255|nullable',
            'supply_ids' => 'required|array',
            'supply_ids.*' => 'integer|exists:supplies,id',
            'prices' => 'required|array',
            'prices.*' => 'decimal:2|min:0',
            'quantities' => 'required|array',
            'quantities.*' => 'numeric|min:1',
            'total_prices' => 'required|array',
            'total_prices.*' => 'decimal:2|min:0',
            'notes' => 'array|nullable',
            'notes.*' => 'string|max:255|nullable',
        ];
    }
}
