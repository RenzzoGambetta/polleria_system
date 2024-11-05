<?php

namespace App\Models;

use App\Models\order\CashierSession;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Person;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Person
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = ['user_id', 'person_id', 'address', 'nationality'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function cashierSessions(): HasMany
    {
        return $this->hasMany(CashierSession::class);
    }
}
