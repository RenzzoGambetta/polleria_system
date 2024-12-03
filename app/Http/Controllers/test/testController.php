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
        $datos = [
            'fecha' => now()->format('d/m/Y H:i'),
            'cliente' => 'Juan Pérez',
            'items' => [
                [
                    'cantidad' => 2,
                    'producto' => 'Pizza Margarita',
                    'precio' => '25.00'
                ],
                [
                    'cantidad' => 1,
                    'producto' => 'Coca Cola 500ml',
                    'precio' => '5.00'
                ],
                [
                    'cantidad' => 3,
                    'producto' => 'Hamburguesa Clásica',
                    'precio' => '15.00'
                ]
            ],
            'total' => '95.00'
        ];
        return view('test.tester-v0', compact('datos'));
    }
    public function viewTestV1(Request $request)
    {
        $Lounge = Lounge::all();
        return view('test.tester-v1', compact('Lounge'));
    }

    public function generarPDF(Request $request)
    {
        // Obtener los datos desde la URL
        $datos = [
            'fecha' => $request->input('fecha', date('Y-m-d')),
            'cliente' => $request->input('cliente', 'Cliente Genérico'),
            'items' => json_decode($request->input('items', '[]'), true),
            'total' => $request->input('total', 0),
        ];

        // Cargar la vista y generar el PDF
        $pdf = Pdf::loadView('test.tester-v0', compact('datos'))
            ->setPaper([0, 0, 226.77, 1000], 'portrait')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true)
            ->setOption('margin_top', 0)
            ->setOption('margin_right', 0)
            ->setOption('margin_bottom', 0)
            ->setOption('margin_left', 0);


        // Retornar el PDF como respuesta
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="boleta.pdf"');
    }
    /*
    Fin del testeo
    */
}
