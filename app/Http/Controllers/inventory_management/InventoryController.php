<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Models\InventoryReceiptDetails;
use App\Models\Supply;
use Illuminate\Http\Request;
use App\Models\User;

class InventoryController extends Controller
{
    protected $Navigationsupply = [
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

        $Inventory = Supply::paginate(10);
        $Navigation = $this->Navigationsupply;
        return view('inventory_management.inventory', compact('Navigation', 'Inventory'));

    }
    public function newsupplyInventory()
    {
        $Navigation = $this->Navigationsupply;
        return view('inventory_management.new_supply_inventory', compact('Navigation'));

    }

    public function showListInventoryMovements()
    {

        $Movement = InventoryReceiptDetails::paginate(10);
        $Navigation = $this->NavigationMovement;
        return view('inventory_management.stock_movement', compact('Navigation', 'Movement'));

    }
}
