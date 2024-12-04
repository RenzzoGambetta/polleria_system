<?php

namespace App\Models\finance;

use App\Models\various\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherPaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = ['voucher_id', 'payment_method_id', 'amount'];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
