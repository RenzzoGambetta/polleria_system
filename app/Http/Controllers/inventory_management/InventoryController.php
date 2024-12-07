<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Supply;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\inventory\InventoryDTOService;

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
    protected $UnitOptions = [
        ['kg', 'kilo'],
        ['g', 'gramo'],
        ['l', 'litro'],
        ['ml', 'mililitro'],
        ['ud', 'unidad']
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
        $UnitOptions = $this->UnitOptions;

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

        $InventoryDTOService = new InventoryDTOService();
        $Movement = $InventoryDTOService->getLatestInventoryMovementsDto();

        // return response()->json($Movement);
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
