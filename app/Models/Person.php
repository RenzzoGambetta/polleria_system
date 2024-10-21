<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Supplier;


class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    protected $fillable = ['dni', 'firstname', 'lastname', 'birthdate', 'gender', 'phone', 'email'];

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    public function supplier(): HasOne
    {
        return $this->hasOne(Supplier::class);
    }
}
