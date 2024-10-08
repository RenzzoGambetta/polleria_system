<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SuppliersController extends Controller
{
    protected $Navigation = [
        'seccion' => 3,
        'sub_seccion' => 3.4,
        'color' => 34
    ];
    public function showSuppliersList(){
        $Suppliers = User::paginate(6);
        $Navigation = $this->Navigation;
        return view('inventory_management.suppliers', compact('Navigation', 'Suppliers'));
    }

    public function showSuppliersRegisterAndEdit(){

        $Navigation = $this->Navigation;
        $reply = 1;
        if($reply = 1){
            $Data = [
                'option'=> 'Registro',
            ];
        }

        return view('inventory_management.register_and_edit_suppliers', compact('Navigation', 'Data'));
    }
    public function newSupplierRegistrationFast(Request $request){

        $companyName = $request->input('company_name');
        $documentNumber = $request->input('document_number');
        $phone = $request->input('phone');



        if($companyName != "null" & $documentNumber != "null" & $phone != "null"){
            $reply = [
                'id' => 222,
                'company_name' => $companyName,
                'document_number' => $documentNumber,
                'phone' => $phone,
                'response' => true
            ];
        }else{
            $reply = [
                'response' => false
            ];
        }

        return response()->json($reply);
    }
    public function listOfSuppliers()
    {
         $Suppliers = [
        ['id' => 1, 'name' => 'Distribuciones Morales'],
        ['id' => 2, 'name' => 'Servicios Martínez'],
        ['id' => 3, 'name' => 'Comercial López'],
        ['id' => 4, 'name' => 'Suministros García'],
        ['id' => 5, 'name' => 'Productos Fernández'],
        ['id' => 6, 'name' => 'Importaciones Pérez'],
        ['id' => 7, 'name' => 'Logística Gómez'],
        ['id' => 8, 'name' => 'Ventas Ruiz'],
        ['id' => 9, 'name' => 'Comercial Ortega'],
        ['id' => 10, 'name' => 'Proveedores Sánchez'],
    ];
        return response()->json($Suppliers);
    }

}
