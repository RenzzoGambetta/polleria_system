<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Supply;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function Supply(): BelongsTo
    {
        return $this->belongsTo(Supply::class);
    }
}
