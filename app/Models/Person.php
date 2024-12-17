<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Supplier;
use App\Models\various\IdentityDocumentType;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'persons';
    protected $fillable = ['document_type_id', 'document_number', 'name', 'lastname', 'company_name', 'birthdate', 'gender', 'phone', 'email'];

    public function documnent_type()
    {
        return $this->belongsTo(IdentityDocumentType::class, 'document_type_id');
    }

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    public function supplier(): HasOne
    {
        return $this->hasOne(Supplier::class);
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }
}
