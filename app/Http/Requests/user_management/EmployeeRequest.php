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
        if ($this->id != null) {
            return [
                'dni' => 'required|size:8', // Se omite la validación de 'dni' en la actualización de un registro con el mismo id.|unique:persons,document_number
                'name' => 'required|string|max:50',
                'paternal_surname' => 'required|string|max:40',
                'maternal_surname' => 'required|string|max:40',
                'birthdate' => 'required|date',
                'gender' => 'nullable',
                'phone' => 'max:20|nullable',
                'email' => 'email|nullable',
                'address' => 'string|max:255|nullable',
                'nationality' => 'string|max:255|nullable',
            ];
        }else{
            return [
                'dni' => 'required|size:8|unique:persons,document_number', // Se omite la validación de 'dni' en la actualización de un registro con el mismo id.
                'name' => 'required|string|max:50',
                'paternal_surname' => 'required|string|max:40',
                'maternal_surname' => 'required|string|max:40',
                'birthdate' => 'required|date',
                'gender' => 'nullable',
                'phone' => 'max:20|nullable',
                'email' => 'email|nullable',
                'address' => 'string|max:255|nullable',
                'nationality' => 'string|max:255|nullable',
            ];

        }
    }
}
