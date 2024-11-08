<?php

namespace App\Http\Requests\inventory;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class supplierRequest extends BaseRequest
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
            'ruc' => 'required|size:8',
            'name' => 'required|string|max:50',
            'birthdate' => 'required|date',
            'gender' => 'nullable|string',
            'phone' => 'required|string|max:20|',
            'email' => 'required|email|',
            'address' => 'required|string|max:255',
        ];
    }
}
