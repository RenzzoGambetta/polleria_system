<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use App\Models\menu\Lounge;
use Illuminate\Http\Request;

class testController extends Controller
{
 /**
     * /test par alas vistas de caja
     * @var ViewTest
     */
    public function viewTest(Request $request)
    {
        $Lounge = Lounge::all();
        return view('temp.view_test', compact('Lounge'));
    }
    /**
     * Fin de funcion
     */
}
