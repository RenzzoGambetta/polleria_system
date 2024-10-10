<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryReceiptDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_id',
        'supply_id',
        'price',
        'discount',
        'quantity',
        'total_amount',
        'note',
    ];

    public function inventoryReceipt()
    {
        return $this->belongsTo(InventoryReceipt::class, 'receipt_id');
    }

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }
}
