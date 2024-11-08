<?php

namespace App\Models;

use App\Models\menu\Lounge;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['lounge_id', 'name', 'category'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }

    public function lounge() 
    {
        return $this->belongsTo(Lounge::class);
    }
}
