<?php

namespace App\Http\Requests\user_management;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends BaseRequest
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
            'username' => 'required|string|max:32|unique:users,username',
            'password' => 'required|string|max:100',
            'password_confirmation' => 'required|string|max:100|same:password',
            'role_id' => 'integer|nullable|exists:roles,id',
            'employee_id' => 'integer|nullable|exists:employees,id',
        ];
    }
}
