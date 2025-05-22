<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use App\Models\menu\Lounge;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

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
        /*Browsershot::html($html)
            ->showBackground() // Asegura que los estilos con fondo se respeten
            ->format('A4') // Formato base, se puede cambiar si necesitas otro
            ->margins(0, 0, 0, 0) // Sin márgenes
            ->setOption('width', 227) // Ancho del PDF en mm
            ->setOption('height', 'auto') // Altura automática en función del contenido
            ->setOption('printBackground', true) // Imprimir los fondos  
            ->setOption('no-images', false)
            ->savePdf($pdfPath);
*/
        // Retornar el PDF como respuesta para mostrarlo en un iframe o descargarlo
        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="boleta.pdf"',
        ]);
    }
    /*
    Fin del testeo
    */
    
    /*
    Test para inprecion de boleta poir ip 
    */
    public function viewTestV2(Request $request)
    {
        $ticket = $this->generarEscPosTicket($request->datos); // puedes pasar los datos desde el frontend
        $ipImpresora = '192.168.1.240'; // IP de tu impresora
        $puerto = 9100;

        try {
            $socket = fsockopen($ipImpresora, $puerto, $errno, $errstr, 5);
            if (!$socket) {
                return response()->json(['error' => "No se pudo conectar: $errstr ($errno)"], 500);
            }

            fwrite($socket, $ticket);
            fclose($socket);

            return response()->json(['estado' => 'Ticket enviado']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function generarEscPosTicket($datos)
    {
        return
        "\x1B\x40" .            // Reset (Inicializa impresora)
        "\x1B\x61\x01" .        // Alinear centrado
        "Tienda XYZ\n" .
        "RUC: 12345678900\n" .
        "Av. Principal 123\n" .
        "-----------------------------\n" .
        "\x1B\x61\x00" .        // Alinear a la izquierda
        "Producto A     x2  S/. 5.00\n" .
        "Producto B     x1  S/. 3.00\n" .
        "-----------------------------\n" .
        "Total:              S/. 13.00\n" .
        "\n" .
        "\x1B\x61\x01" .        // Centrar de nuevo
        "Gracias por su compra\n" .
        "\n\n" .
        "\x1D\x56\x41" .
        "\x1B\x40" ;         // Corte total (ESC/POS full cut)
        
    }
   /*
    Fin del testeo
    */
    public function generateThermalPdf()
    {
        // Datos de ejemplo (debes reemplazar con tus datos reales)
        $data = [
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

        // Configurar el PDF para 80mm de ancho
        $pdf = Pdf::loadView('test.tester-v0', $data)
            ->setPaper([0, 0, 226.77, 1000], 'portrait'); // 80mm ≈ 226.77 puntos (1mm = 2.83465 puntos)

        // Opciones:
        // 1. Descargar el PDF
        // return $pdf->download('ticket.pdf');
        
        // 2. Ver en el navegador
        return $pdf->stream('ticket.pdf');
        
        // 3. Guardar en el servidor
        // $pdf->save(storage_path('app/public/tickets/ticket.pdf'));
        
        // 4. Enviar directamente a la impresora (requiere configuración adicional)
        // return response($pdf->output(), 200)
        //     ->header('Content-Type', 'application/pdf')
        //     ->header('Content-Disposition', 'inline; filename="ticket.pdf"');
    }
}
