<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_id',
        'voucher_serie',
        'correlative_number',
        'supplier_id',
        'issuance_date',
        'expiration_date',
        'total_amount',
        'payment_type',
        'commentary',
    ];

    public function voucherType()
    {
        return $this->belongsTo(VoucherType::class, 'voucher_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
