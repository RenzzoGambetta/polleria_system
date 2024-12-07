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
use Illuminate\Support\Facades\Log;

class TableController extends Controller
{
    protected $NavigationTable = [
        'seccion' => 4,
        'sub_seccion' => 4.2,
        'color' => 42
    ];
    protected $loungeService;

    public function __construct(LoungeService $loungeService)
    {
        $this->loungeService = $loungeService;
    }
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

    public function newLounge(LoungeRequest $request)
    {
        try {

            $lounge = $this->loungeService->createLounge($request->validated());

            return response()->json([
                'result' => true,
                'id' => $lounge->id
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
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'lounge_id' => 'required|integer|exists:lounges,id',
        ]);

        $quantity = $validated['quantity'];
        $loungeId = $validated['lounge_id'];

        try {

            $tablesToDelete = Table::where('lounge_id', $loungeId)
                ->orderBy('id', 'desc')
                ->take($quantity)
                ->get();

            if ($tablesToDelete->isEmpty()) {
                return response()->json(['result' => false, 'message' => 'No hay mesas para eliminar.']);
            }

            Table::whereIn('id', $tablesToDelete->pluck('id'))->delete();

            return response()->json(['result' => true, 'message' => 'Mesas eliminadas correctamente.']);
        } catch (\Throwable $e) {
            Log::error('Error al eliminar mesas: ' . $e->getMessage());

            return response()->json(['result' => false, 'message' => 'Hubo un error al eliminar las mesas.'], 500);
        }
    }
    /*
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
*/
    public function newTable(Request $request)
    {

        $validated = $request->validate([
            'quantity' => 'nullable|integer|min:1',
            'lounge_id' => 'nullable|integer|exists:lounges,id',
        ]);

        $quantity = $validated['quantity'] ?? 1;
        $loungeId = $validated['lounge_id'] ?? 1;

        try {
            $lastTable = Table::where('lounge_id', $loungeId)
                ->latest('id')
                ->first();
            $lastCode = $lastTable ? $lastTable->code : 0;
            $tables = [];
            for ($i = 0; $i < $quantity; $i++) {
                $tables[] = [
                    'code' => $lastCode + $i + 1,
                    'lounge_id' => $loungeId,
                    'status' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Table::insert($tables);
            return response()->json(['result' => true]);
        } catch (\Throwable $e) {
            Log::error('Error al crear tablas: ' . $e->getMessage());
            return response()->json(['result' => false], 500);
        }
    }
}
