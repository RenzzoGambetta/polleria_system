<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Http\Global\ConstGlobal;
use App\Http\Global\FunctionGlobal;
use App\Models\Brand;
use App\Models\Supply;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\inventory\InventoryDTOService;


class InventoryController extends Controller
{
    protected $NavigationSupply, $NavigationMovement;

    public function __construct()
    {
        $this->NavigationSupply = FunctionGlobal::NavigationFast(3,0);
        $this->NavigationMovement = FunctionGlobal::NavigationFast(3,1);
    }

    public function showInventoryList()
    {
        $Navigation = $this->NavigationSupply;
        $Inventory = Supply::orderBy('id', 'desc')->paginate(ConstGlobal::PAGINATION);
        return view('inventory_management.inventory', compact('Navigation', 'Inventory'));
    }
    public function newsupplyInventory(Request $request)
    {
        $Navigation = $this->NavigationSupply;
        $UnitOptions = ConstGlobal::UNIT_OPTIONS;

        if ($request->filled(['id'])) {

            $Supply = Supply::where('id', $request->id)->first();
            $Supply['brandName']  = Brand::where('id', $Supply->brand_id)->value('name');
            $Supply['isEdit'] = true;
            $Supply['title'] = 'Editar suministro';

        }else{
            $Supply['title'] = 'Registro nuevo suministro';

        }
        return view('inventory_management.new_supply_inventory', compact('Navigation','UnitOptions','Supply'));
    }

    public function showListInventoryMovements()
    {
        /*
        *   Implementacion temporal del servicio de movimeintos, implementa tu logica propia
        */

        $Movement = (new InventoryDTOService())->getLatestInventoryMovementsDto()->sortByDesc('date_order');

        // return response()->json($Movement);
        $Navigation = $this->NavigationMovement;
        return view('inventory_management.stock_movement', compact('Navigation', 'Movement'));
    }
    public function deleteNewSupplyComplete(Request $request)
    {
        $response = Supply::destroy($request->id); 

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
