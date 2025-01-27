<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Http\Global\ConstGlobal;
use App\Http\Global\FunctionGlobal;
use App\Http\Requests\inventory\CreateFastSupplierRequest;
use App\Http\Requests\inventory\supplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\inventory\SupplierService;
use Exception;

class SuppliersController extends Controller
{
    protected $Navigation;

    public function __construct()
    {
        $this->Navigation = FunctionGlobal::NavigationFast(3, 4);
    }
    public function showSuppliersList()
    {
        $Navigation = $this->Navigation;
        $Suppliers = Supplier::orderBy('created_at', 'desc')->paginate(ConstGlobal::PAGINATION);
        return view('inventory_management.suppliers', compact('Navigation', 'Suppliers'));
    }

    public function showSuppliersRegisterAndEdit(Request $request)
    {
        $Navigation = $this->Navigation;

        if ($request->action == 'edit') {
            $Data = supplier::find($request->id);
            $Data ['option'] = 'Editar' ;
        }else{
            $Data = [
                'option' => 'Registro',
            ];
        }
        //return response()->json($Data);
        return view('inventory_management.register_and_edit_suppliers', compact('Navigation', 'Data'));
    }
    public function newSupplierRegistrationFast(CreateFastSupplierRequest $request)
    {
        try {
            $data = $request->validated();
            $Mesage = (new SupplierService)->createFastSupplier($data);
            $Mesage["response"] = true;
        } catch (Exception $e) {
            $Mesage = [
                'response' => $e
            ];
        }
        return response()->json($Mesage);
    }
    public function listOfSuppliers()
    {
        $Suppliers = Supplier::all();
        $data = [];

        foreach ($Suppliers as $supplier) {
            $data[] = [
                'id' => $supplier->id,
                'name' => $supplier->person->document_number . " | " . $supplier->person->name,
            ];
        }

        return response()->json($data);
    }
    public function newSupplierRegistration(supplierRequest $request)
    {
        try {
            (new SupplierService)->createSupplier($request->validated());
            return redirect()->route('suppliers');
        } catch (Exception $e) {
            return redirect()->route('suppliers')->error($e);
        }
    }
    public function deleteSupplier(Request $request)
    {
        try {
            $data = (new SupplierService)->deleteSupplier(Supplier::find($request->id));
            return redirect()->route('suppliers')->with(FunctionGlobal::MessageSuccess('Se elimino correctamente el proveedor.'));
        } catch (Exception $e) {
            return redirect()->route('suppliers')->with(FunctionGlobal::MessageError('Lo sentimos no se pudo eliminar este proveedor',10,$e->getMessage()));
        }
    }
}
