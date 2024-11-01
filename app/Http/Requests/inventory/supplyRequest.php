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
            'brand_name' => 'string|max:50|nullable',
            'code' => 'string|max:15|nullable',
            'name' => 'required|string|max:100',
            'is_stockable' => 'string|nullable',
            'stock' => 'integer|nullable',
            'unit' => 'required|string|max:15|nullable',
            'note' => 'string|max:255|nullable'
        ];
    }

}
