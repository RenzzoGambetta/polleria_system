<?php

namespace App\Http\Requests\inventory;

use App\Http\Requests\util_request\BaseRequest;

class BrandRequest extends BaseRequest
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
            'name' => 'required|string|max:50|unique:brands,name',
            'description' => 'string|max:255|nullable'
        ];
    }
}
