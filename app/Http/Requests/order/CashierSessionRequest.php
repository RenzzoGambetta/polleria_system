<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class CashierSessionRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'employee_id' => 'required|integer|exists:employee,id',
            'opening_balance' => 'required|decimal:2|max_digits:8',
        ];
    }
}
