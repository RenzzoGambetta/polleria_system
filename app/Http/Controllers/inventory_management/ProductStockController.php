<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    protected $Navigation = [
        'seccion' => 3,
        'sub_seccion' => 3.1,
        'color' => 31
    ];
    public function showPanelRegisterEntry()
    {

        $Navigation = $this->Navigation;
        $Productos = Role::all();
        return view('inventory_management.product_stock_entry', compact('Navigation' , 'Productos'));

    }
}
