<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Http\Requests\inventory\InventoryIssueRequest;
use App\Http\Requests\inventory\inventoryReceiptRequest;
use App\Http\Requests\inventory\supplyRequest;
use App\Models\InventoryIssue;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\Supply;
use App\Models\various\VoucherType;
use App\Services\inventory\InventoryIssueService;
use App\Services\inventory\InventoryReceiptService;
use App\Services\inventory\supplyService;
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
    protected $supplyService;

    public function __construct(supplyService $supplyService)
    {
        $this->supplyService = $supplyService;
    }

    public function showPanelRegisterEntry()
    {

        $Navigation = $this->NavigationEntry;
        $Voucher = VoucherType::select('id', 'name')->get();

        return view('inventory_management.supply_stock_entry', compact('Navigation', 'Voucher'));
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
            ->leftJoin('inventory_movement_details', function ($join) {
                $join->on('inventory_movement_details.supply_id', '=', 'supplies.id')
                    ->whereRaw('inventory_movement_details.id = (
                    SELECT id FROM inventory_movement_details AS ird
                    WHERE ird.supply_id = supplies.id
                    ORDER BY ird.created_at DESC
                    LIMIT 1
                )');
            })
            ->where('supplier_supply.supplier_id', $request->id)
            ->select(
                'supplies.id',
                'supplies.name',
                DB::raw('COALESCE(inventory_movement_details.quantity, 1) AS quantity'),
                DB::raw('COALESCE(inventory_movement_details.price, 0) AS price_per_unit')
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

        $validator = $request->toArray();
        $validator['unit'] = $request->unit_measure;
        if ($request->name != "null" & $request->unit != "null") {
            $reply = $this->supplyService->createSupply($validator);
            $reply['response'] = true;
        } else {
            $reply = [
                'response' => false
            ];
        }
        return response()->json($reply);
    }
    public function registerNewSupplyComplete(supplyRequest $request)
    {
        try {
            $validator = $request->validated();
            if ($request->filled(['id_edit_stock'])) {
                $response = $this->supplyService->updateSupply($request->id_edit_stock,$validator);
                return redirect()->route('inventory')->with([
                    'Message' => 'Se edito el suministro satisfactoriamente.',
                    'Type' => 'success'
                ]);
            }
            $response = $this->supplyService->createSupply($validator);
            if ($response) {
                return redirect()->route('inventory')->with([
                    'Message' => 'Se registro el suministro satisfactoriamente.',
                    'Type' => 'success'
                ]);
            }
        } catch (Exception $e) {

            return redirect()->route('new_supply_inventory')->withInput()->with([
                'Message' => 'No se pudo registrar el suminsitro.',
                'Type' => 'error'
            ]);
        }
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
    public function registerSupplyEntry(inventoryReceiptRequest $request)
    {
        try {
            $data = $request->validated();
            $inventoryReceiptService = new InventoryReceiptService();
            $entry = $inventoryReceiptService->createInventoryReceipt($data);

            return redirect()->route('show_panel_register_entry');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la entrada: ' . $e->getMessage()
            ], 500);
        }
    }
    public function registerSupplyOutput(InventoryIssueRequest $request)
    {
        try {
            $data = $request->validated();
            $inventoryIssueService = new InventoryIssueService();
            $entry = $inventoryIssueService->createInventoryIssue($data);

            return redirect()->route('show_panel_register_output');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la entrada: ' . $e->getMessage()
            ], 500);
        }
    }
    public function querySupplyData(Request $request)
    {

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
