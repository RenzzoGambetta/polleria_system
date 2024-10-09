<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lounge extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'floor', 'address'];

    public function tables()
    {
        return $this->hasMany(Table::class);
    }
}
