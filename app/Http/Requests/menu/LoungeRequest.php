<?php

namespace App\Http\Requests\menu;

use Illuminate\Foundation\Http\FormRequest;

class LoungeRequest extends FormRequest
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
            'code' => 'size:4|unique:lounges,code',
            'name' => 'required|string|max:75',
            'floor' => 'integer|between:1,255',
            'address' => 'string|max:255'
        ];
    }
}
