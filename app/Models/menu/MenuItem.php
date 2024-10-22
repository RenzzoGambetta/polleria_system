<?php

namespace App\Models\menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'price', 'is_combo', 'display_order', 'image'];

    public function category()
    {
        return $this->belongsTo(MenuCategory::class);
    }

    public function comboDetails() 
    {
        if ($this->is_combo == false) return;

        return $this->belongsToMany(MenuItem::class, 'combo_item_details')
                    ->withPivot('item_quantity')
                    ->withTimestamps();
    }
}
