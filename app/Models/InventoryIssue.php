<?php

namespace App\Models;

use App\Models\inventory\InventoryMovementDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryIssue extends Model
{
    use HasFactory;

    protected $fillable = ['outgoing_date', 'reason'];

    public function details()
    {
        return $this->hasMany(InventoryMovementDetail::class, 'issue_id');
    }
}
