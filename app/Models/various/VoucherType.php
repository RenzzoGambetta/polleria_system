<?php

namespace App\Models\various;

use App\Models\InventoryReceipt;
use App\Models\order\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'abbreviation', 'voucher_name'];

    public function inventoryReceipts()
    {
        return $this->hasMany(InventoryReceipt::class, 'voucher_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'voucher_id');
    }
}
