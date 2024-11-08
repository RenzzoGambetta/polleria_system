<?php

namespace App\Http\Requests\user_management;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeRequest extends BaseRequest
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
            'dni' => 'required|size:8|unique:persons,document_number',
            'name' => 'required|string|max:50',
            'paternal_surname' => 'required|string|max:40',
            'maternal_surname' => 'required|string|max:40',
            'birthdate' => 'required|date',
            'gender' => 'boolean|nullable',
            'phone' => 'string|max:20|nullable',
            'email' => 'email|nullable',
            'address' => 'string|max:255|nullable',
            'nationality' => 'string|max:255|nullable',
        ];
    }
}
