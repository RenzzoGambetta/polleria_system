<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($StockMovement) }}">
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

<div class="mobile-option">
    <a href="{{ route('show_panel_register_output') }}" title="Nueva Salida" class="a-arrow arrow-down"><i class='bx bxs-downvote bx-rotate-180'></i></a><a href="{{ route('show_panel_register_entry') }}" title="Nueva Entrada" class="a-arrow arrow-up"><i class='bx bxs-downvote'></i></a>
</div>

<div class="header">
    <div class="left">
        <h1>Movimientos</h1>
        <ul class="breadcrumb">

            <a href="{{ route('inventory') }}" class="active">
                Movimientos
            </a>
            <li>
                /
            </li>

        </ul>
    </div>
</div>

<div class="container-option-select">
    <div class="tabs">
        <input type="radio" id="radio-1" name="tabs" value="supply" checked="">
        <label class="tab" for="radio-1">Todos los movimientos <i class="fi fi-sr-archive icon-image-section"></i></label>
        <input type="radio" id="radio-2" name="tabs" value="item">
        <label class="tab" for="radio-2">Solo Entradas <i class="fi fi-sr-down icon-image-section"></i></label>
        <input type="radio" id="radio-3" name="tabs" value="combo">
        <label class="tab" for="radio-3">Solo Salidas <i class="fi fi-sr-up icon-image-section"></i></label>
        <span class="glider"></span>
    </div>
</div>
<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Lista</h3>

            <div class="btn-optin desktop"><a href="{{ route('show_panel_register_output') }}" title="Nueva Salida" class="a-arrow arrow-down"><i class='bx bxs-downvote bx-rotate-180'></i></a><a href="{{ route('show_panel_register_entry') }}" title="Nueva Entrada" class="a-arrow arrow-up"><i class='bx bxs-downvote'></i></a></div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Dia</th>
                    <th>Monto</th>
                    <th>Provedor</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($Movement as $Movements)
                    <tr
                    @if ($Movements['type'] == 'Entrada')
                     style="color: var(--movement-type-color-text-tr-input)"
                    @elseif ($Movements['type'] == 'Salida')
                     style="color: var( --movement-type-color-text-tr-output)"
                    @endif
                    >
                        <td class="type-movement">
                            @if ($Movements['type'] == 'Entrada')
                            <i class="fi fi-br-arrow-down"></i>
                            @elseif ($Movements['type'] == 'Salida')
                            <i class="fi fi-br-arrow-up"></i>
                            @endif
                            {{ $Movements['type'] }}
                            
                        </td>
                        <td>{{ $Movements['date'] }}</td>
                        <td>s/ {{ $Movements['total_amount'] }}</td>
                        <td>{{ $Movements['proveedor'] ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
