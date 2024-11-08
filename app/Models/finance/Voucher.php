<?php

namespace App\Models\finance;

use App\Models\InventoryReceipt;
use App\Models\various\PaymentMethod;
use App\Models\various\VoucherSerie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_serie_id',
        'correlative_number',
        'issuance_date',
        'expiration_date',
        'total_amount',
        'payment_type',
        'payment_method_id',
        'commentary',
    ];

    public function inventoryReceipt() 
    {
        return $this->hasOne(InventoryReceipt::class);
    }

    public function voucherSerie() 
    {
        return $this->belongsTo(VoucherSerie::class);
    }

    public function paymentMethod() 
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
