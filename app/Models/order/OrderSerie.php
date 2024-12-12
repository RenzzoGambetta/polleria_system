<?php

namespace App\Models\order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSerie extends Model
{
    use HasFactory;

    protected $fillable = ['order_serie', 'last_correlative_number'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
