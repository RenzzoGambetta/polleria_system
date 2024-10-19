<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

        return view('inventory_management.supply_stock_entry', compact('Navigation'));
    }
    public function showPanelRegisterOutput()
    {

        $Navigation = $this->NavigationOutput;

        return view('inventory_management.supply_stock_output', compact('Navigation'));
    }
    public function suppliersupplyList(Request $request)
    {

        $idData = validator::make(
            $request->all(),
            [
                'id' => 'required|size:5',
            ]
        );

        $id = $request->input('id');
        /*
        $produc = DB::table('supplies')
        ->join('supplier_supplies', 'supplies.id', '=', 'supplier_supplies.supplies_id')
        ->where('supplier_supplies.supplier_id', $id)
        ->select('supplies.*', 'supplier_supplies.note')
        ->get();

*/
        $idData = validator::make(
            $request->all(),
            [
                'id' => 'required|size:5',
            ]
        );

        $id = $request->input('id');
        if ($id == 1) {
            $produc = [
                [
                    'id' => 1,
                    'name' => 'Pollo entero',
                    'quantity' => 100,
                    'price_per_unit' => 12.00
                ],
                [
                    'id' => 2,
                    'name' => 'Papas',
                    'quantity' => 500, // en kilogramos
                    'price_per_unit' => 1.50 // en moneda local
                ],
            ];
        } else if ($id == 2) {
            $produc = [
                [
                    'id' => 5,
                    'name' => 'Pimienta',
                    'quantity' => 20, // en kilogramos
                    'price_per_unit' => 5.00 // en moneda local
                ],
                [
                    'id' => 6,
                    'name' => 'Ajo',
                    'quantity' => 100, // en kilogramos
                    'price_per_unit' => 4.00 // en moneda local
                ],
                [
                    'id' => 7,
                    'name' => 'Ají panca',
                    'quantity' => 80, // en kilogramos
                    'price_per_unit' => 6.00 // en moneda local
                ]
            ];
        } else if ($id == 3) {
            $produc = [
                [
                    'id' => 9,
                    'name' => 'Culantro',
                    'quantity' => 50, // en manojos
                    'price_per_unit' => 2.00 // en moneda local
                ],
                [
                    'id' => 10,
                    'name' => 'Vinagre',
                    'quantity' => 150, // en litros
                    'price_per_unit' => 2.50 // en moneda local
                ]
            ];
        } else if ($id == 4) {
            $produc = [
                [
                    'id' => 4,
                    'name' => 'Sal',
                    'quantity' => 50, // en kilogramos
                    'price_per_unit' => 0.50 // en moneda local
                ],
                [
                    'id' => 5,
                    'name' => 'Pimienta',
                    'quantity' => 20, // en kilogramos
                    'price_per_unit' => 5.00 // en moneda local
                ],
                [
                    'id' => 6,
                    'name' => 'Ajo',
                    'quantity' => 100, // en kilogramos
                    'price_per_unit' => 4.00 // en moneda local
                ],
                [
                    'id' => 7,
                    'name' => 'Ají panca',
                    'quantity' => 80, // en kilogramos
                    'price_per_unit' => 6.00 // en moneda local
                ],
                [
                    'id' => 8,
                    'name' => 'Comino',
                    'quantity' => 30, // en kilogramos
                    'price_per_unit' => 7.00 // en moneda local
                ],
                [
                    'id' => 9,
                    'name' => 'Culantro',
                    'quantity' => 50, // en manojos
                    'price_per_unit' => 2.00 // en moneda local
                ]
            ];
        } else {
            $produc = [
                [
                    'id' => 1,
                    'name' => 'Pollo entero',
                    'quantity' => 100, // en unidades
                    'price_per_unit' => 12.00 // en moneda local
                ],
                [
                    'id' => 2,
                    'name' => 'Papas',
                    'quantity' => 500, // en kilogramos
                    'price_per_unit' => 1.50 // en moneda local
                ],
                [
                    'id' => 3,
                    'name' => 'Aceite vegetal',
                    'quantity' => 200, // en litros
                    'price_per_unit' => 3.00 // en moneda local
                ],
                [
                    'id' => 4,
                    'name' => 'Sal',
                    'quantity' => 50, // en kilogramos
                    'price_per_unit' => 0.50 // en moneda local
                ],
                [
                    'id' => 5,
                    'name' => 'Pimienta',
                    'quantity' => 20, // en kilogramos
                    'price_per_unit' => 5.00 // en moneda local
                ],
                [
                    'id' => 6,
                    'name' => 'Ajo',
                    'quantity' => 100, // en kilogramos
                    'price_per_unit' => 4.00 // en moneda local
                ],
                [
                    'id' => 7,
                    'name' => 'Ají panca',
                    'quantity' => 80, // en kilogramos
                    'price_per_unit' => 6.00 // en moneda local
                ],
                [
                    'id' => 8,
                    'name' => 'Comino',
                    'quantity' => 30, // en kilogramos
                    'price_per_unit' => 7.00 // en moneda local
                ],
                [
                    'id' => 9,
                    'name' => 'Culantro',
                    'quantity' => 50, // en manojos
                    'price_per_unit' => 2.00 // en moneda local
                ],
                [
                    'id' => 10,
                    'name' => 'Vinagre',
                    'quantity' => 150, // en litros
                    'price_per_unit' => 2.50 // en moneda local
                ]
            ];
        }

        return response()->json($produc);
    }
    public function listOfsupplys()
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
    public function anchorsupplyProvider(Request $request)
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
    public function registersupplyEntry(Request $request)
    {



        return response()->json($request);
    }
}
