<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            margin: 0;
            padding: 0;
            width: 80mm;
        }

        .ticket {
            padding: 10px;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <p class="center bold">Mi Restaurante</p>
        <p class="center">RUC: 12345678901</p>
        <p class="center">Av. Ejemplo 123</p>
        <p class="center">Tel: 987654321</p>
        <div class="line"></div>
        <p>Fecha: {{ $datos['fecha'] ?? '' }}</p>
        <p>Cliente: {{ $datos['cliente'] ?? '' }}</p>
        <div class="line"></div>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: left;">Cant</th>
                    <th style="text-align: left;">Producto</th>
                    <th style="text-align: right;">Precio</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($datos['items']))
                    @foreach ($datos['items'] as $item)
                        <tr>
                            <td>{{ $item['cantidad'] ?? '' }}</td>
                            <td>{{ $item['producto'] ?? '' }}</td>
                            <td style="text-align: right;">S/ {{ number_format($item['precio'] ?? 0, 2) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" style="text-align: center;">No hay datos disponibles</td>
                    </tr>
                @endif

            </tbody>
        </table>
        <div class="line"></div>
        <p style="text-align: right;">Total: S/ {{ $datos['total'] ?? '' }}</p>
        <p class="center">¡Gracias por su compra!</p>
    </div>
</body>

</html>
