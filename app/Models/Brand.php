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

<<<<<<< HEAD
    public function suppliers(): BelongsTo
=======
    public function Supply(): BelongsTo
>>>>>>> 6b50f5a (implementacion de migraciones y fabricas de los modelos marca, proveedor e insumo)
    {
        return $this->belongsTo(Supply::class);
    }
}
