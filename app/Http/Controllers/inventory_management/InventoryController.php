<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class InventoryController extends Controller
{
    protected $Navigation = [
        'seccion' => 3,
        'sub_seccion' => 3.0,
        'color' => 30
    ];
    public function showInventoryList()
    {

        $Inventory = User::paginate(6);
        $Navigation = $this->Navigation;
        return view('inventory_management.inventory', compact('Navigation', 'Inventory'));

    }
}
