<?php

namespace App\Http\Requests\user_management;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends BaseRequest
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
        if ($this->id != null) {
            return [
                'name' => 'required|max:50', // buscar la forma de manejarlo de otra formaque sea unico pero sin contar el que ya esta
                'permissions' => 'required|array',
                'permissions.*' => 'integer|exists:permissions,id',

            ];
        } else {
            return [
                'name' => 'required|max:50|unique:roles,name',
                'permissions' => 'required|array',
                'permissions.*' => 'integer|exists:permissions,id',

            ];
        }
    }
}
