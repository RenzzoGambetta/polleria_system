<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;


class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    protected $fillable = ['dni', 'firstname', 'lastname', 'birthdate', 'gender', 'phone', 'email'];

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }
}
