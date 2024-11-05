<?php

namespace App\Http\Requests\menu;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoungeRequest extends BaseRequest
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
            'code' => 'size:4|unique:lounges,code',
            'name' => 'required|string|max:75',
            'floor' => 'integer|between:1,255',
            'address' => 'string|max:255',
            'prefix_code_tables' => 'string|max:2' 
        ];
    }
}
