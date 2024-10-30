<?php

namespace App\Models\menu;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookingPlace extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function menuItems() 
    {
        return $this->hasMany(MenuItem::class, 'cooking_place_id');
    }

    public function roles() 
    {
        return $this->hasMany(Role::class, 'cooking_place_id');
    }
}
