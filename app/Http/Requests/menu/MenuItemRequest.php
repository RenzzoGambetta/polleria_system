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
        $rules = [
            'name' => 'required|string|max:124',
            'price' => 'required|decimal:0,2|min:0',
            'is_combo' => 'integer|between:0,1',
            'category_id' => 'integer|nullable|exists:menu_categories,id',
            'cooking_place_id' => 'integer|nullable|exists:cooking_places,id',
            'comment' => 'string|max:255|nullable',
            //Nombres de variables funcionales pero incorrectas
            'quantity_item_compact' => 'array|nullable',
            'quantity_item_compact.*' => 'decimal:0,2|min:0',
        ];

        if ($this->is_combo) {
            $rules['id_item_compact'] = 'array|nullable';
            $rules['id_item_compact.*'] = 'integer|exists:menu_items,id';
            
        } else {
            $rules['id_item_compact'] = 'array|nullable';
            $rules['id_item_compact.*'] = 'integer|exists:supplies,id';
        }

        return $rules;
    }
}
