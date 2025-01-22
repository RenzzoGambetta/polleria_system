<?php

namespace App\Http\Requests\order;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditOrderDetailsRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'menu_item_ids' => 'required|array',
            'menu_item_ids.*' => 'integer|exists:menu_items,id',
            'prices' => 'required|array',
            'prices.*' => 'decimal:0,2|min:0',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
            'total_prices' => 'required|array',
            'total_prices.*' => 'decimal:0,2|min:0',
            'is_delibery_details' => 'array|nullable',
            'is_delibery_details.*' => 'boolean',
            'notes' => 'array|nullable',
            'notes.*' => 'string|max:100|nullable',
        ];
    }
}
