<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'abbreviation'];

    public function inventoryReceipts()
    {
        return $this->hasMany(InventoryReceipt::class, 'voucher_id');
    }
}
