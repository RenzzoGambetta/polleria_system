<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Models\Brand;
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
    public function newsupplyInventory(Request $request)
    {
        $Navigation = $this->Navigationsupply;

        if ($request->filled(['id'])) {

            $Supply = Supply::where('id', $request->id)->first();
            $Supply['brandName']  = Brand::where('id', $Supply->brand_id)->value('name');
            $Supply['isEdit'] = true;
            return  view('inventory_management.new_supply_inventory', compact('Navigation', 'Supply'));
        }
        return view('inventory_management.new_supply_inventory', compact('Navigation'));
    }

    public function showListInventoryMovements()
    {

        $Movement = InventoryReceiptDetails::paginate(10);
        $Navigation = $this->NavigationMovement;
        return view('inventory_management.stock_movement', compact('Navigation', 'Movement'));
    }
    public function deleteNewSupplyComplete(Request $request)
    {
        $response = Supply::destroy($request->id); // Cambié 'Delate' a 'destroy' para eliminar correctamente

        if ($response) {
            return redirect()->route('inventory')->with([
                'Message' => 'Se eliminó satisfactoriamente.',
                'Type' => 'success'
            ]);
        }

        return redirect()->route('new_supply_inventory', ['id' => $request->id])->withInput()->with([
            'Message' => 'No se pudo eliminar el suministro.',
            'Type' => 'error'
        ]);
    }
}
