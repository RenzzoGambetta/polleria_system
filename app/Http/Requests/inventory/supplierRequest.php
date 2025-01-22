<?php

namespace App\Http\Requests\inventory;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class supplierRequest extends BaseRequest
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
        if ($this->id != null) 
        {
            return [
                'ruc' => 'required|string|min:8|max:11',
                'name' => 'required|string|max:50',
                'birthdate' => 'date|nullable',
                'gender' => 'string|nullable',
                'phone' => 'string|max:20|nullable',
                'email' => 'email|nullable',
                'address' => 'string|max:255|nullable',
            ];
        } 
        else {
            return [
                'ruc' => 'required|string|min:8|max:11|unique:persons,document_number',
                'name' => 'required|string|max:50',
                'birthdate' => 'date|nullable',
                'gender' => 'string|nullable',
                'phone' => 'string|max:20|nullable',
                'email' => 'email|nullable',
                'address' => 'string|max:255|nullable',
            ];
        }
        
    }
}
