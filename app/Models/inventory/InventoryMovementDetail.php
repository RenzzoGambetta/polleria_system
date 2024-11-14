<?php

namespace App\Models\inventory;

use App\Models\InventoryIssue;
use App\Models\InventoryReceipt;
use App\Models\Supply;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovementDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_id',
        'issue_id',
        'supply_id',
        'price',
        'discount',
        'quantity',
        'total_amount',
        'note',
    ];

    public function inventoryReceipt()
    {
        return $this->belongsTo(InventoryReceipt::class, 'receipt_id');
    }

    public function inventoryIssue()
    {
        return $this->belongsTo(InventoryIssue::class, 'inssue_id');
    }

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }
}
