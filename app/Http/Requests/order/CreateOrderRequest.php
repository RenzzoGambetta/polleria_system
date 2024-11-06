<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
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
            'table_id' => 'required|integer|exists:tables,id',
            'waiter_id' => 'required|integer|exists:users,id',
            'is_delibery' => 'boolean',
            'commentary' => 'string|max:255|nullable',
            'menu_item_ids' => 'required|array',
            'menu_item_ids.*' => 'integer|exists:menu_items,id',
            'prices' => 'required|array',
            'prices.*' => 'decimal:2|min:0',
            'quantities' => 'required|array',
            'quantities.*' => 'numeric|min:1',
            'total_prices' => 'required|array',
            'total_prices.*' => 'decimal:2|min:0',
            'is_delibery_details' => 'array|nullable',
            'is_delibery_details.*' => 'boolean',
            'notes' => 'array|nullable',
            'notes.*' => 'string|max:100|nullable',
        ];
    }
}
