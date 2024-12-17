<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Person;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['person_id', 'address'];

    public function person() : BelongsTo 
    {
        return $this->belongsTo(Person::class);
    }

    public function inventoryReceipts()
    {
        return $this->hasMany(InventoryReceipt::class, 'supplier_id');
    }

    public function supplies()
    {
        return $this->belongsToMany(Supply::class)
                    ->withPivot('note')
                    ->withTimestamps();
    }

    public function updateRelatedSupplies($suppliesIdAndNoteArray)
    {
        return $this->supplies()->sync($suppliesIdAndNoteArray);
        //FORMATO DE DATOS: [ 
        //     $supplyId1 => ['note' => 'nota 1' ],
        //     $supplyId2 => ['note' => 'nota 2' ]
        //     ]
    }
}
