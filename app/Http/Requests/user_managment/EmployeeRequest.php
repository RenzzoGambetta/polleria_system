<?php

namespace App\Http\Requests\user_management;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeRequest extends FormRequest
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
            'dni' => 'required',
            'name' => 'required|string|max:50',
            'paternal_surname' => 'required|string|max:50',
            'maternal_surname' => 'required|string|max:50',
            'birthdate' => 'required|date',
            'gender' => 'nullable',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = "Completa el campo obligatorio";
        throw new HttpResponseException(
            redirect()->back()->with('Ms', $errors)->withErrors($validator->errors())->withInput()
        );
    }
}
