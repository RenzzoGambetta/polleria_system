<?php

namespace App\Http\Requests\order;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CashierSessionRequest extends BaseRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'employee_id' => 'required|integer|exists:employees,id',
            'opening_balance' => 'required|numeric|regex:/^\d{1,6}(\.\d{1,2})?$/',
            'note' => 'nullable|string|max:255',
        ];
    }
}
