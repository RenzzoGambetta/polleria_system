<?php

namespace App\Http\Requests\inventory;

use App\Http\Requests\util_request\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class InventoryIssueRequest extends BaseRequest
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
            'comment' => 'string|max:255|nullable',
            'id' => 'required|array',
            'id.*' => 'integer|exists:supplies,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
        ];
    }
}
