<?php

namespace App\Models\various;

use App\Models\finance\Voucher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abbreviation'];

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
}
