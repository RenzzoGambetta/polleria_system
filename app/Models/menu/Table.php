<?php

namespace App\Models\menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['lounge_id', 'code', 'status'];

    public function lounge()
    {
        return $this->belongsTo(Lounge::class);
    }
}
