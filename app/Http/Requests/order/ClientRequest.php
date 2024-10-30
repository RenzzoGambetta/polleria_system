<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'dni' => 'size:8',
            'name' => 'required|string|max:50',
            'lastname' => 'string|max:50',
            'birthdate' => 'date',
            'gender' => 'nullable',
            'phone' => 'string|max:20',
            'email' => 'email',
            'address' => 'string|max:255',
            'type' => 'string|max:100',
        ];
    }
}
