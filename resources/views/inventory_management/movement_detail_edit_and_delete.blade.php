<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($StyleMovementDetail) }}">
@if (session()->has('Message'))
    <div class="container-aler">
        <div class="alert-error-and-response {{ session('Type') ?? 'error' }}">
            <div class="message-title-and-timer">
                <span class="tilte-alert">Mensaje:</span>
                <span class="sub-title-time" id="timer">{{ session('Time') ?? 10 }}s</span>
            </div>
            <span class="text-alert">{{ session('Message') }}</span>
        </div>
    </div>
    <script>
        timeAlert({{ session('Time') ?? 10 }})
    </script>
@endif
@csrf

<div class="header">
    <div class="left">
        <h1>{{ $Data['title'] }}</h1>
        <ul class="breadcrumb">

            <a href="{{ route('inventory') }}" class="pagina">
                Inventario
            </a>
            <li>
                /
            </li>
            <a href="{{ route('show_list_inventory_movements') }}" class="pagina">
                Movimientos
            </a>
            /
            </li>
            <a href="{{ route('show_list_inventory_movements') }}" class="active">
                {{ $Data['title'] }}
            </a>
        </ul>
    </div>
</div>

<input type="checkbox" id="theme-toggle" hidden>

<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Lista</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Suministro</th>
                    <th>Cantidad</th>
                    <th>Pecio</th>
                    <th>Sub Total</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($MovementDetail as $movementDetail)
                    <tr>
                        <td>{{ $movementDetail->supply->name }}</td>
                        <td>{{ $movementDetail->quantity }}</td>
                        <td>{{ $movementDetail->price }}</td>
                        <td>{{ $movementDetail->total_amount }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
