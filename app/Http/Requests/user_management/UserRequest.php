<?php

namespace App\Http\Requests\user_management;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->id != null) {
            return [
                'username' => 'required|string|max:32',
                'password' => 'string|nullable|max:100',
                'password_confirmation' => 'string|nullable|max:100|same:password',
                'role_id' => 'integer|nullable|exists:roles,id',
                'employee_id' => 'integer|nullable|exists:employees,id',
            ];
        } else {
            return [
                'username' => 'required|string|max:32|unique:users,username',
                'password' => 'required|string|max:100',
                'password_confirmation' => 'required|string|max:100|same:password',
                'role_id' => 'integer|nullable|exists:roles,id',
                'employee_id' => 'integer|nullable|exists:employees,id',
            ];
        }
    }
}
