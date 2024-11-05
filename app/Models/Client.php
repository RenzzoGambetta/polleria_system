<?php

namespace App\Models;

use App\Models\order\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'type'];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
