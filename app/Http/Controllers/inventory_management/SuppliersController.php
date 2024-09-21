<?php

namespace App\Http\Controllers\inventory_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SuppliersController extends Controller
{
    protected $Navigation = [
        'seccion' => 3,
        'sub_seccion' => 3.2,
        'color' => 32
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
}
