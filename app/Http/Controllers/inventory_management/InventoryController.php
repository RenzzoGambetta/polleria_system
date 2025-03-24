<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Http\Global\ConstGlobal;
use App\Http\Global\FunctionGlobal;
use App\Models\Brand;
use App\Models\inventory\InventoryMovementDetail;
use App\Models\InventoryIssue;
use App\Models\InventoryReceipt;
use App\Models\Supply;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\inventory\InventoryDTOService;

use function PHPSTORM_META\type;

class InventoryController extends Controller
{
    protected $NavigationSupply, $NavigationMovement;

    public function __construct()
    {
        $this->NavigationSupply = FunctionGlobal::NavigationFast(3, 0);
        $this->NavigationMovement = FunctionGlobal::NavigationFast(3, 1);
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
        } else {
            $Supply['title'] = 'Registro nuevo suministro';
        }
        return view('inventory_management.new_supply_inventory', compact('Navigation', 'UnitOptions', 'Supply'));
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
        try{
            $response = Supply::destroy($request->id);
    
            if ($response) {
                return redirect()->route('inventory')->with(FunctionGlobal::MessageSuccess('Se eliminó satisfactoriamente.'));
            }
    
            return redirect()->route('new_supply_inventory', ['id' => $request->id])->withInput()->with(FunctionGlobal::MessageError('No se pudo eliminar el suministro.'));
        }catch(Exception $e){
            return redirect()->route('inventory')->withInput()->with(FunctionGlobal::MessageError('No se pudo eliminar el suministro.'));

        }
    }
    public function getMovementDetailByType(Request $request)
    {
        try {
            $Navigation = $this->NavigationMovement;

            if (!$request->filled(['id', 'type'])) {
                return redirect()->route('movement_detail')
                    ->with(FunctionGlobal::MessageError('Parámetros insuficientes.'));
            }

            $DataMovement = null;

            if ($request->type === 'Entrada') {

                // $MovementDetail = InventoryMovementDetail::where('receipt_id', $request->id)->get();
                $DataMovement = InventoryReceipt::find($request->id);
            } elseif ($request->type === 'Salida') {
                //$DataMovement = InventoryMovementDetail::where('issue_id', $request->id)->get();
                $DataMovement = InventoryIssue::find($request->id);
            }

            if ($request->wantsJson()) {
                return response()->json($DataMovement);
            }

            $MovementDetail = $DataMovement->details()->get();

            if ($MovementDetail->isEmpty()) {
                return redirect()->route('movement_detail')
                    ->with(FunctionGlobal::MessageError('No se encontró el detalle del movimiento.'));
            }

            $MovementDetail->title = 'Detalle de movimiento';
            $Data['isEdit'] = $MovementDetail->first()->created_at->diffInDays(now()) <= 1;
            $Data['isNote'] = $MovementDetail->contains(fn($item) => !is_null($item->note));
            $Data['title'] = $request->type;
            //return response()->json($MovementDetail);
            return view(
                'inventory_management.movement_detail_edit_and_delete',
                compact('Navigation', 'MovementDetail', 'Data', 'DataMovement')
            );
        } catch (Exception $e) {
            return redirect()->route('show_list_inventory_movements')->with(FunctionGlobal::MessageError('No se puede acceder por una incopativilidad de datos.'));
        }
    }
}
