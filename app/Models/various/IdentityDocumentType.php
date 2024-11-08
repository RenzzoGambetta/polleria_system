<?php

namespace App\Models\various;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentityDocumentType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abbreviation', 'digit_length'];

    public function persons()
    {
        return $this->hasMany(Person::class, 'document_type_id');
    }
}
