<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id', 'code', 'name', 'is_stockable', 'stock', 'unit', 'note'];

    public function brand() : HasOne
    {
        return $this->hasOne(Brand::class);
    }

    public function inventoryReceiptDetails() : HasMany
    {
        return $this->hasMany(InventoryReceiptDetails::class, 'supply_id');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supply::class)
                    ->withPivot('note')
                    ->withTimestamps();
    }

    public function menuItemDetails()
    {
        return $this->belongsToMany(Supply::class, 'menu_supply_details')
                    ->withPivot('supply_quantity')
                    ->withTimestamps();
    }
}
