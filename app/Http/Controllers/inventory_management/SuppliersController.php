<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Http\Requests\inventory\supplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\inventory\SupplierService;

class SuppliersController extends Controller
{
    protected $Navigation = [
        'seccion' => 3,
        'sub_seccion' => 3.4,
        'color' => 34
    ];
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }
    public function showSuppliersList()
    {
        $Suppliers = Supplier::paginate(10);
        $Navigation = $this->Navigation;
        return view('inventory_management.suppliers', compact('Navigation', 'Suppliers'));
    }

    public function showSuppliersRegisterAndEdit()
    {

        $Navigation = $this->Navigation;
        $reply = 1;
        if ($reply = 1) {
            $Data = [
                'option' => 'Registro',
            ];
        }

        return view('inventory_management.register_and_edit_suppliers', compact('Navigation', 'Data'));
    }
    public function newSupplierRegistrationFast(Request $request)
    {

        $companyName = $request->input('company_name');
        $documentNumber = $request->input('document_number');
        $phone = $request->input('phone');



        if ($companyName != "null" & $documentNumber != "null" & $phone != "null") {

            $data = $request->validated();
            $response = $this->supplierService->createFastSupplier($data);
            $response["response"] = true;

        } else {
            $response = [
                'response' => false
            ];
        }

        return response()->json($response);
    }
    public function listOfSuppliers()
    {
        $Suppliers = Supplier::all();
        $data = [];

        foreach ($Suppliers as $supplier) {
            $data[] = [
                'id' => $supplier->id,
                'name' => $supplier->person->dni."|".$supplier->person->firstname,
            ];
        }

        return response()->json($data);
    }
    public function newSupplierRegistration(supplierRequest $request){

        $data = $request->validated();
        $response = $this->supplierService->createSupplier($data);
        return response()->json($response);
    }
}
