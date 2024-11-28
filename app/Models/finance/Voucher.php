<?php

namespace App\Models\finance;

use App\Models\InventoryReceipt;
use App\Models\order\Order;
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
        'commentary',
    ];

    public function inventoryReceipt() 
    {
        return $this->hasOne(InventoryReceipt::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function paymentDetails() 
    {
        return $this->hasMany(VoucherPaymentDetail::class);
    }

    public function voucherSerie() 
    {
        return $this->belongsTo(VoucherSerie::class);
    }
    
}
