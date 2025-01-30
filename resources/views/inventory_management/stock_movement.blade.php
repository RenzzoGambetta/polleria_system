<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
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
@csrf

<div class="mobile-option">
    <a href="{{ route('show_panel_register_output') }}" title="Nueva Salida" class="a-arrow arrow-down"><i class='bx bxs-downvote bx-rotate-180'></i></a><a href="{{ route('show_panel_register_entry') }}" title="Nueva Entrada" class="a-arrow arrow-up"><i class='bx bxs-downvote'></i></a>
</div>

<div class="header">
    <div class="left">
        <h1>Movimientos</h1>
        <ul class="breadcrumb">
            <a href="{{ route('inventory') }}" class="pagina">
                Inventario
            </a>
            <li>
                /
            <a href="{{ route('inventory') }}" class="active">
                Movimientos
            </a>
        </ul>
    </div>
</div>

<div class="container-option-select">
    <div class="tabs">
        <input type="radio" id="radio-1" name="tabs" value="allSupply" checked="">
        <label class="tab" for="radio-1">Todos los movimientos <i class="fi fi-sr-archive icon-image-section"></i></label>
        <input type="radio" id="radio-2" name="tabs" value="entrySupply">
        <label class="tab" for="radio-2">Solo Entradas <i class="fi fi-sr-down icon-image-section"></i></label>
        <input type="radio" id="radio-3" name="tabs" value="OutputSupply">
        <label class="tab" for="radio-3">Solo Salidas <i class="fi fi-sr-up icon-image-section"></i></label>
        <span class="glider"></span>
    </div>
</div>
<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <div class="dub-block-001">
                <span>Del</span>
                <div class="col-3 input-effect date-time">
                    <input type="date" name="start_date" id="start_date" class="effect-16" placeholder=" ">
                    <span class="focus-border"></span>
                </div>
                <span>al</span>
                <div class="col-3 input-effect date-time">
                    <input type="date" name="end_date" id="end_date" class="effect-16" placeholder=" " value="{{ date('Y-m-d') }}">
                    <span class="focus-border"></span>
                </div>
            </div>

            <div class="btn-optin desktop"><a href="{{ route('show_panel_register_output') }}" title="Nueva Salida" class="a-arrow arrow-down"><i class='bx bxs-downvote bx-rotate-180'></i></a><a href="{{ route('show_panel_register_entry') }}" title="Nueva Entrada" class="a-arrow arrow-up"><i class='bx bxs-downvote'></i></a></div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Dia</th>
                    <th>Cantidad</th>
                    <th>Monto</th>
                    <th>Provedor</th>
                </tr>
            </thead>
            <tbody></tbody>
            <script>
                const movements = @json($Movement);
            </script>
        </table>
        <div id="pagination" class="pagination-container"></div>
    </div>
</div>
<script src="{{ asset($FilterTransactions) }}"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
