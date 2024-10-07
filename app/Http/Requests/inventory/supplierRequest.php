<?php

namespace App\Http\Requests\inventory;

use Illuminate\Foundation\Http\FormRequest;

class supplierRequest extends FormRequest
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
            'brand_name' => 'string|max:50',
            'code' => 'string|max:15',
            'name' => 'required|string|max:64',
            'is_stockable' => 'required|boolean',
            'unit' => 'string|required|max:15',
            'note' => 'string|max:255'
        ];
    }
}
