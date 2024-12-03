<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use App\Models\menu\Lounge;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class testController extends Controller
{

    /*
    Test para las boletas y generar una fase beta 
    */
    public function viewTestV0(Request $request)
    {
        $Lounge = Lounge::all();
        return view('test.tester-0', compact('Lounge'));
    }
    public function viewTestV1(Request $request)
    {
        $Lounge = Lounge::all();
        return view('test.tester-1', compact('Lounge'));
    }

    public function generarPDF(Request $request)
    {
        // Datos del ticket (puedes traerlos del request o de la base de datos)
        $datos = $request->all();

        // Cargar la vista y generar el PDF
        $pdf = Pdf::loadView('boletas.boleta', compact('datos'))
            ->setPaper([0, 0, 226.77, 1000]); // 80 mm de ancho, altura inicial arbitraria (se ajusta automáticamente)

        // Retornar el PDF como respuesta
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="boleta.pdf"');
    }
    /*
    Fin del testeo
    */
}
