<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class InventoryController extends Controller
{
    protected $NavigationProduct = [
        'seccion' => 3,
        'sub_seccion' => 3.0,
        'color' => 30
    ];
    protected $NavigationMovement = [
        'seccion' => 3,
        'sub_seccion' => 3.1,
        'color' => 31
    ];
    public function showInventoryList()
    {

        $Inventory = User::paginate(6);
        $Navigation = $this->NavigationProduct;
        return view('inventory_management.inventory', compact('Navigation', 'Inventory'));

    }
    public function newProductInventory()
    {
        $Navigation = $this->NavigationProduct;
        return view('inventory_management.new_product_inventory', compact('Navigation'));

    }

    public function showListInventoryMovements()
    {

        $Movement = User::paginate(6);
        $Navigation = $this->NavigationMovement;
        return view('inventory_management.stock_movement', compact('Navigation', 'Movement'));

    }
}
