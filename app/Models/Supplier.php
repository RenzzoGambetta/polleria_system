<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Person;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'address'];

    public function person() : BelongsTo 
    {
        return $this->belongsTo(Person::class);
    }

    public function inventoryReceipts()
    {
        return $this->hasMany(InventoryReceipt::class, 'supplier_id');
    }
}
