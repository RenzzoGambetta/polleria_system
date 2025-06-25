<?php

namespace App\Http\Controllers\config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Global\ConstGlobal;
use App\Http\Global\FunctionGlobal;
use App\Models\menu\MenuCategory;
use App\Http\Global\FuctionTest;
use Exception;

class CookingPlaceController extends Controller
{
    protected $Navigation;

    public function __construct()
    {
        $this->Navigation = FunctionGlobal::NavigationFast(7, 2);
    }

    public function showCookingPlace()
    {
        $Navigation = $this->Navigation;
        $Command = FuctionTest::convertArrayObject([
            ['id' => 1, 'name' => 'Caja Principal',     'ip' => '192.168.1.10', 'port' => '9100', 'state' => 1],
            ['id' => 2, 'name' => 'Cocina 1',           'ip' => '192.168.1.11', 'port' => '9100', 'state' => 1],
            ['id' => 3, 'name' => 'Barra',              'ip' => '192.168.1.12', 'port' => '9100', 'state' => 0],
            ['id' => 4, 'name' => 'Despacho',           'ip' => '192.168.1.13', 'port' => '9101', 'state' => 1],
            ['id' => 5, 'name' => 'Caja Secundaria',    'ip' => '192.168.1.14', 'port' => '9100', 'state' => 1],
            ['id' => 6, 'name' => 'Recepción',          'ip' => '192.168.1.15', 'port' => '9102', 'state' => 0],
            ['id' => 7, 'name' => 'Delivery',           'ip' => '192.168.1.16', 'port' => '9100', 'state' => 1],
            ['id' => 8, 'name' => 'Buffet',             'ip' => '192.168.1.17', 'port' => '9100', 'state' => 0],
            ['id' => 9, 'name' => 'Cocina 2',           'ip' => '192.168.1.18', 'port' => '9103', 'state' => 1],
            ['id' => 10, 'name' => 'Bar 2',              'ip' => '192.168.1.19', 'port' => '9100', 'state' => 0],
        ]);
        return view('config.cooking_place', compact('Navigation', 'Command'));
    }

    public function editToCookingPlace(Request $request)
    {
        try {

            $Message = [
                'name' => $request->name,
                'ip' => $request->ip,
                'port' => $request->port,
                'state' => $request->state,
                'response' => true
            ];
        } catch (Exception $e) {
            $Message = [
                'response' => $e->getMessage(),
            ];
        }

        return response()->json($Message);
    }

    public function deleteToCookingPlace(Request $request)
    {
        try {
            $Message = [
                'response' => true,
            ];
        } catch (Exception $e) {
            $Message = [
                'response' => $e->getMessage(),
            ];
        }

        return response()->json($Message);
    }

    public function newCommandCookingPlace(Request $request)
    {
        try {
            $Message = [
                'name' => $request->name,
                'ip' => $request->ip,
                'port' => $request->port,
                'state' => $request->state,
                'response' => true
            ];
        } catch (Exception $e) {
            $Message = [
                'response' => $e->getMessage(),
            ];
        }

        return response()->json($Message);
    }

    public function commandTest(Request $request)
    {/*
        // Buscar el dispositivo por ID
        $device = Command::find($request->id);

        if (!$device) {
            return response()->json([
                'response' => false,
                'message' => 'Dispositivo no encontrado',
            ]);
        }

        // Intentar conexión al puerto de la impresora (simulado)
        $ticket = $this->generarEscPosTicket($request->datos);
        $ip = $device->ip;
        $port = $device->port;
        $timeout = 5; // segundos

        try {
            $connection = fsockopen($ip, $port, $errno, $errstr, $timeout);

            if ($connection) {
                fwrite($connection, $ticket);
                fclose($connection);
                return response()->json([
                    'response' => true,
                    'message' => 'Conexión exitosa a la impresora.'
                ]);
            } else {
                return response()->json([
                    'response' => false,
                    'message' => 'No se pudo conectar con la impresora.'
                ]);
            }

        } catch (Exception $e) {
            return response()->json([
                'response' => false,
                'message' => 'Error al intentar conectar: ' . $e->getMessage()
            ]);
        }
    */
        return response()->json([
            'response' => false,
            'message' => 'Error al intentar conectar: '
        ]);
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
            "\x1B\x40";         // Corte total (ESC/POS full cut)

    }
}
