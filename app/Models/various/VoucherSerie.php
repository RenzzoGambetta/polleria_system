<?php

namespace App\Models\various;

use App\Models\finance\Voucher;
use App\Models\various\VoucherType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherSerie extends Model
{
    use HasFactory;

    protected $fillable = ['voucher_type_id', 'serie_number', 'last_correlative_number'];

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function voucherType() 
    {
        return $this->belongsTo(VoucherType::class);
    }
}
