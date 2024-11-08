<?php

namespace App\Models\menu;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lounge extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'floor', 'address'];

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function permission() 
    {
        return $this->hasOne(Permission::class);
    }
}
