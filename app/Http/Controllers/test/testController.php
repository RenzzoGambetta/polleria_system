<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use App\Models\menu\Lounge;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

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
        // Datos para la vista
        $datos = [
            'fecha' => $request->input('fecha', date('Y-m-d')),
            'cliente' => $request->input('cliente', 'Cliente Genérico'),
            'items' => json_decode($request->input('items', '[]'), true),
            'total' => $request->input('total', 0),
        ];

        // Renderizar la vista Blade a HTML
        $html = view('test.tester-v0', compact('datos'))->render();

        // Ruta para guardar el PDF generado
        $pdfPath = storage_path('app/public/boleta.pdf');

        // Generar el PDF con Browsershot
        Browsershot::html($html)
            ->showBackground() // Asegura que los estilos con fondo se respeten
            ->format('A4') // Formato base, se puede cambiar si necesitas otro
            ->margins(0, 0, 0, 0) // Sin márgenes
            ->setOption('width', 227) // Ancho del PDF en mm
            ->setOption('height', 'auto') // Altura automática en función del contenido
            ->setOption('printBackground', true) // Imprimir los fondos  
            ->setOption('no-images', false)
            ->savePdf($pdfPath);

        // Retornar el PDF como respuesta para mostrarlo en un iframe o descargarlo
        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="boleta.pdf"',
        ]);
    }
    /*
    Fin del testeo
    */
}
