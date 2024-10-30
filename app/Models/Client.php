<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'type'];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
