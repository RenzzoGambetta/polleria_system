<?php

namespace App\Http\Controllers\menu_management;

use App\Http\Controllers\Controller;
use App\Http\Requests\menu\LoungeRequest;
use App\Models\menu\Lounge;
use App\Models\menu\Table;
use App\Services\menu\LoungeService;
use Illuminate\Http\Request;
use Exception;
use PhpParser\Node\Stmt\Return_;

class TableController extends Controller
{
    protected $NavigationTable = [
        'seccion' => 4,
        'sub_seccion' => 4.2,
        'color' => 42
    ];
    public function showDrawingTable(Request $request)
    {
        $Lounge = Lounge::all();
        $Navigation = $this->NavigationTable;
        return view('menu_management.table_edit_and_register', compact('Navigation', 'Lounge'));
    }
    public function tablesListData(Request $request)
    {
        $Tables = Table::select('id', 'code as name', 'status')->where('lounge_id', $request->id)->get();
        return response()->json($Tables);
    }
    public function loungeDataEdit(Request $request)
    {
        $Lounge = Lounge::where('id', $request->id)->first();
        return response()->json($Lounge);
    }

    /*
    * CAMBIAR EL REQUEST POR LOUNGE REQUEST
    */
    public function newLounge(Request $request)
    {   
        try {
            // Crear una nueva instancia de Lounge y almacenar en $lounge
            $validator = $request->validate([
                'code' => 'string|size:4|unique:lounges,code',
                'name' => 'required|string|max:75',
                'floor' => 'string',
                'address' => 'string|max:255',
            ]);
            $loungeService = new LoungeService();
            $lounge = $loungeService->createLounge($validator);

            // Retornar el ID del nuevo registro junto con el resultado
            return response()->json([
                'result' => true,
                'id' => $lounge->id // ID del nuevo lounge
            ]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
    }

    public function editLounge(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'code' => 'required|string|max:10',
            'floor' => 'required',
            'id' => 'required'
        ]);
        try {
            $lounge = Lounge::findOrFail($validatedData['id']);
            $lounge->update([
                'name' => $validatedData['name'],
                'address' => $validatedData['address'],
                'code' => $validatedData['code'],
                'floor' => $validatedData['floor']
            ]);
            return response()->json(['result' => true]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
    }
    public function delateLounge(Request $request)
    {
        try {
            Table::where('lounge_id', $request->id)->delete();
            Lounge::where('id', $request->id)->delete();

            return response()->json(['result' => true]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
    }
    public function delateTable(Request $request)
    {
        try {
            Table::where('id', $request->id)->delete();

            return response()->json(['result' => true]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
    }
    public function editTable(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'code' => 'required'
        ]);
        try {
            $lounge = Table::findOrFail($validatedData['id']);
            $lounge->update([
                'code' => $validatedData['code']
            ]);
            return response()->json(['result' => true]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
    }

    public function newTable(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required',
            'lounge_id' => 'required',

        ]);

        try {
            Table::create([
                'code' => $validatedData['code'],
                'lounge_id' => $validatedData['lounge_id'],
                'status' =>0
            ]);

            return response()->json(['result' => true]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
    }
}
