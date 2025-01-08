<?php

namespace App\Http\Requests\inventory;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class supplyRequest extends BaseRequest
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
            'brand_name' => 'nullable|string|max:50',
            'code' => 'nullable|string|max:15',
            'name' => 'required|string|max:100',
            'is_stockable' => 'nullable|string',
            'stock' => 'nullable|integer',
            'unit' => 'nullable|string|max:15',
            'note' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
