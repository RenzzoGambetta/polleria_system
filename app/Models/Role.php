<?php

namespace App\Models;

use App\Models\menu\CookingPlace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['cooking_place_id','name'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public function cookingPlace()
    {
        return $this->belongsTo(CookingPlace::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public function updatePermissions($idPermissionsArray)
    {
        return $this->permissions()->sync($idPermissionsArray);
    }
}
