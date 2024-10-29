<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Http\Requests\inventory\inventoryReceiptRequest;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\Supply;
use App\Models\VoucherType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;
class SupplyStockController extends Controller
{
    protected $NavigationEntry = [
        'seccion' => 3,
        'sub_seccion' => 3.3,
        'color' => 33
    ];
    protected $NavigationOutput = [
        'seccion' => 3,
        'sub_seccion' => 3.2,
        'color' => 32
    ];
    public function showPanelRegisterEntry()
    {

        $Navigation = $this->NavigationEntry;
        $Voucher = VoucherType::select('id', 'name')->get();

        return view('inventory_management.supply_stock_entry', compact('Navigation','Voucher'));
    }
    public function showPanelRegisterOutput()
    {

        $Navigation = $this->NavigationOutput;

        return view('inventory_management.supply_stock_output', compact('Navigation'));
    }
    public function supplierSupplyList(Request $request)
    {

        $produc = DB::table('supplier_supply')
        ->join('supplies', 'supplier_supply.supply_id', '=', 'supplies.id')
        ->leftJoin('inventory_receipt_details', function ($join) {
            $join->on('inventory_receipt_details.supply_id', '=', 'supplies.id')
                ->whereRaw('inventory_receipt_details.id = (
                    SELECT id FROM inventory_receipt_details AS ird
                    WHERE ird.supply_id = supplies.id
                    ORDER BY ird.created_at DESC
                    LIMIT 1
                )');
        })
        ->where('supplier_supply.supplier_id', $request->id)
        ->select(
            'supplies.id',
            'supplies.name',
            DB::raw('COALESCE(inventory_receipt_details.quantity, 1) AS quantity'),
            DB::raw('COALESCE(inventory_receipt_details.price, 0) AS price_per_unit')
        )
        ->get();

        return response()->json($produc);
    }
    public function listOfSupplys()
    {

        $supply = Supply::all();
        return response()->json($supply);
    }
    public function registerNewsupply(Request $request)
    {

        $name = $request->input('name');
        $unit_measure = $request->input('unit_measure');
        $is_stockable = $request->input('is_stockable');
        $save_option = $request->input('save_option');


        if ($name != "null" & $unit_measure != "null") {
            $reply = [
                'id' => 22,
                'name' => $name,
                'unit_measure' => $unit_measure,
                'is_stockable' => $is_stockable,
                'save_option' => $save_option,
                'response' => true
            ];
        } else {
            $reply = [
                'response' => false
            ];
        }

        return response()->json($reply);
    }
    public function anchorSupplyProvider(Request $request)
    {
        $idData = validator::make(
            $request->all(),
            [
                'supplierId' => 'required',
                'supplyId' => 'required',
            ]
        );

        $supplyId = $request->input('supplyId');
        $supplierId = $request->input('supplierId');
        if ($supplyId != "null") {
            $reply = [

                'supplyo' => $supplyId,
                'provedor' => $supplierId,
                'mensage' => 'Totos los productos fueron registrados con exito'

            ];
        } else {
            $reply = [

                'supplyo' => $supplyId,
                'provedor' => $supplierId,
                'mensage' => 'El registro no se pude realizar'

            ];
        }

        return response()->json($reply);
    }
    public function registerSupplyEntry(inventoryReceiptRequest  $request)
    {

        try {


            // Responde con éxito en JSON
            return response()->json([
                'status' => 'success',
                'message' => 'Inventory receipt created successfully!',
                'data' => $request
            ], 201);

        } catch (ValidationException $e) {
            // Captura los errores de validación específicos
            return response()->json([
                'status' => 'error',
                'errors' => $e->validator->errors()
            ], 422);

        } catch (Exception $e) {
            // Captura cualquier otro tipo de error
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'details' => $e->getMessage()  // Puedes eliminar este campo en producción
            ], 500);
        }
    }
    public function querySupplyData(Request $request){

        $id = $request->input('id');

        $item = DB::table('supplies')
            ->select('id', 'name', 'unit', 'stock')
            ->where('id', $id)
            ->first();


        if ($item) {
            return response()->json($item);
        } else {
            return response()->json(['error' => 'Item no encontrado'], 404);
        }
    }
}
