<?php

namespace App\Http\Controllers\menu_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableController extends Controller
{
    protected $NavigationTable = [
        'seccion' => 4,
        'sub_seccion' => 4.2,
        'color' => 42
    ];
    public function showDrawingTable(Request $request)
    {
        $Navigation = $this->NavigationTable;
        return view('menu_management.table_edit_and_register', compact('Navigation'));
    }
}
