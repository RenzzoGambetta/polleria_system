<?php

namespace App\Http\Requests\menu;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest
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
            'name' => 'required|string|max:124',
            'price' => 'required|decimal:0,2|min:0',
            'category_id' => 'integer|nullable|exists:menu_categories,id',
            'cooking_place_id' => 'integer|nullable|exists:cooking_places,id',
            'comment' => 'string|max:255|nullable',
            //Nombres de variables funcionales pero incorrectas
            'id_item_compact' => 'array|nullable',
            'id_item_compact.*' => 'integer|exists:supplies,id',
            'quantity_item_compact' => 'array|nullable',
            'quantity_item_compact.*' => 'decimal:0,2|min:0',
        ];
    }
}
