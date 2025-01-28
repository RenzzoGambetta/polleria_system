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
            $Data ['subButthon'] = 'Editar' ;
            $Data ['urlAccet'] = 'supplier_update' ;
        }else{
            $Data = [
                'option' => 'Registro',
                'subButthon' => 'Registrar',
                'urlAccet' => 'new_supplier_registration'
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
                'name' => ($supplier->person->document_number ?? '00000000') . " | " . ($supplier->person->name ?? 'anonimo'),

            ];
        }
        return response()->json($data);
    }
    public function newSupplierRegistration(supplierRequest $request)
    {
        try {
            (new SupplierService)->createSupplier($request->validated());
            return redirect()->route('suppliers')->with(FunctionGlobal::MessageSuccess('Se Registro satisfactoriamente.'));
        } catch (Exception $e) {
            return redirect()->route('suppliers')->with(FunctionGlobal::MessageError('Lo sentimos no se pudo registrar el proveedor',10,$e->getMessage()));
        }
    }
    public function updateSupplier(supplierRequest $request){
        try {
            (new SupplierService)->updateSupplier(supplier::find($request->id),$request->validated());
            return redirect()->route('suppliers')->with(FunctionGlobal::MessageSuccess('Se edito satisfactoriamente los datos del proveedor.'));
        } catch (Exception $e) {
            return redirect()->route('suppliers')->with(FunctionGlobal::MessageError('Lo sentimos no se pudo editar el proveedor',10,$e->getMessage()));
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
    public function showDataSupplier(Request $Data)
    {
        $Info = Supplier::find($Data->id);
        $Info['title']='Proveedor';
        $Info['sub_title']='Datos de porveedor';
        $Info['data']=$Data->id;
        $Info['type']='supplier';
        $Info['url']='data_supplier_block';


        $Navigation = $this->Navigation;

        return view('user_management.data_employer', compact('Navigation', 'Info'));
    }
}
