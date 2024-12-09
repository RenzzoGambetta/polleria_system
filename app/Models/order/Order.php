<?php

namespace App\Models\order;

use App\Models\Client;
use App\Models\finance\Voucher;
use App\Models\menu\Table;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'client_id',
        'table_id',
        'cashier_session_id',
        'waiter_id',
        'voucher_id',
        'status',
        'is_delibery',
        'commentary',
    ];
    
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function cashierSession()
    {
        return $this->belongsTo(CashierSession::class);
    }

    public function waiter()
    {
        return $this->belongsTo(User::class, 'waiter_id');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }
}
