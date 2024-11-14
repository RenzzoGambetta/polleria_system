<?php

namespace App\Http\Requests\order;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends BaseRequest
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
            'dni' => 'string|size:8|nullable',
            'name' => 'required|string|max:50',
            'lastname' => 'string|max:50|nullable',
            'birthdate' => 'date|nullable',
            'gender' => 'boolean|nullable',
            'phone' => 'string|max:20|nullable',
            'email' => 'email|nullable',
            'address' => 'string|max:255|nullable',
            'type' => 'string|max:100|nullable',
        ];
    }
}
