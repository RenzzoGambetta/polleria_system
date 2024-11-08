<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use App\Http\Requests\inventory\CreateFastSupplierRequest;
use App\Http\Requests\inventory\supplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\inventory\SupplierService;
use Exception;

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
    public function newSupplierRegistrationFast(CreateFastSupplierRequest $request)
    {
        try {
            $data = $request->validated();
            $response = $this->supplierService->createFastSupplier($data);
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

        $data = $request->validated();
        $response = $this->supplierService->createSupplier($data);
        return redirect()->route('suppliers');
    }
}
