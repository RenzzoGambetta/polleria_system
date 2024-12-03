<!DOCTYPE html>
<html>
<link rel="stylesheet" href="{{ asset($StyleDocument) }}">

<body>
    <div class="ticket">
        <div class="image-document-icon">
            <img src="{{ asset($DocumentLogo) }}" alt="D'BRAZZA DORADA">
        </div>
        <div class="center bold title capital">D'Brazza dorada</div>
        <div class="center">RUC: 20612460401</div>
        <div class="center">Alfonso Ugarte III ET Mz. A5 Lt:11</div>
        <div class="center">Tel: 948447099</div>
        <hr>
        <div class="type-document-data">
            <span class="type-docuemt capital">Boleta de ventan electronica</span>
            <span class="number-document capital">Ba02-00003895</span>
        </div>
        <hr>
        <div class="document-client-and-origin">
            <div class="moment-to-order">
                <span class="date-order">FECHA : 26/12/2024</span>
                <span class="time-order">HORA : 04:41:12 PM</span>
            </div>
            <div class="attention-type">
                ATENCION :<span class="area-of-attention"> Preimera 1 - Mesa : 2</span>
            </div>
            <div>CLIENTE: {{ $datos['cliente'] }}</div>
            <div>DNI: 71571704</div>
        </div>
        <hr style="margin-bottom: 0">
        <div class="table-data-order">
            <table>
                <tr>
                    <th>PRODUCTO</th>
                    <th class="right">CANT.</th>
                    <th class="right">P.U.</th>
                    <th class="right">IMP.</th>
                </tr>
            </table>
            <hr style="margin: 0">
            <table>
                @foreach ($datos['items'] as $item)
                    <tr>
                        <td>{{ $item['producto'] }}</td>
                        <td class="right">{{ $item['cantidad'] }}</td>
                        <td class="right">5.00</td>
                        <td class="right" class="right">{{ number_format($item['precio'], 2) }}</td>
                    </tr>
                @endforeach
            </table>
            <hr>

            <table class="detalle">
                <tr>
                    <td>SUB TOTAL</td>
                    <td class="right">22.00</td>
                </tr>
                <!--
                 <tr>
                    <td>DESCUENTO</td>
                    <td class="right">0.00</td>
                </tr>
                -->

                <tr>
                    <td>OP. GRAVADA</td>
                    <td class="right">20.00</td>
                </tr>
                <tr>
                    <td>OP. EXONERADA</td>
                    <td class="right">0.00</td>
                </tr>
                <tr>
                    <td>I.G.V. 18%</td>
                    <td class="right">2.00</td>
                </tr>
            </table>
            <hr>
            <table>
                <tr class="total">
                    <td>IMPORTE A PAGAR</td>
                    <td class="right">22.00</td>
                </tr>
            </table>
            <div class="inpor-total-text">
                <span>SON: VENTIDOS CON 00/100 Soles</span>
            </div>
            <hr>
            <table>
                <tr>
                    <td>EFECTIVO</td>
                    <td class="right">22.00</td>
                </tr>
            </table>
            <hr>
            <table>
                <tr>
                    <td>PAGO CON</td>
                    <td class="right">22.00</td>
                </tr>
                <tr>
                    <td>VUELTO</td>
                    <td class="right">0.00</td>
                </tr>
            </table>
        </div>

        <div class="center">¡Gracias por su compra!</div>
    </div>
</body>

</html>
