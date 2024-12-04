<?php

namespace App\Models\various;

use App\Models\finance\Voucher;
use App\Models\finance\VoucherPaymentDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abbreviation'];

    public function voucherPaymentDetails()
    {
        return $this->hasMany(VoucherPaymentDetail::class, 'payment_method_id');
    }
}
