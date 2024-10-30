<?php

namespace App\Models\order;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierSession extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'employee_id', 'opening_balance', 'cash_open_at', 'cash_close_at'];

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
