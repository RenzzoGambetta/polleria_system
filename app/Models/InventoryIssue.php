<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryIssue extends Model
{
    use HasFactory;

    protected $fillable = ['outgoing_date', 'reason'];

    public function details()
    {
        return $this->hasMany(InventoryReceiptDetails::class, 'inssue_id');
    }
}
