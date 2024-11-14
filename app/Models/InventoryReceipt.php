<?php

namespace App\Models;

use App\Models\finance\Voucher;
use App\Models\inventory\InventoryMovementDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_id',
        'supplier_id',
        'total_amount',
        'incoming_date',
        'commentary',
    ];

    public function details() 
    {
        return $this->hasMany(InventoryMovementDetail::class, 'receipt_id');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
