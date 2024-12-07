<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<script src="{{ asset($AlertSrc) }}"></script>
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($TableEditAndRegister) }}">
<link rel="stylesheet" href="{{ asset($loaderOrder) }}">
<link rel="stylesheet" href="{{ asset($ItemSelectionAlert) }}">
<link rel="stylesheet" href="{{ asset($SearchBox) }}">
<link rel="stylesheet" href="{{ asset($pointModify) }}">

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
<div class="option-to-nav-table-container">
    <div class="option-to-nav-table">
        <span class="limit-data top-spam"></span>
        <div class="salas-conteiner">
            <div class="conteiner-salas-btn">
                <button class="scroll-btn left" onmousedown="startAutoScroll(-1, true)" onmouseup="stopAutoScroll()" onmouseout="stopAutoScroll()">‹</button>
                <div class="tabs-container" id="tabs-container">
                    @foreach ($Lounge as $Lounges)
                        <button class="button button-data-lounges" id="button_{{ $Lounges->id }}" onclick="loadTableData({{ $Lounges->id }},'{{ $Lounges->name }}')">{{ $Lounges->name }}</button>
                    @endforeach
                </div>
                <button class="scroll-btn right" onmousedown="startAutoScroll(1, true)" onmouseup="stopAutoScroll()" onmouseout="stopAutoScroll()">›</button>
            </div>
        </div>
        <span class="limit-data limit-not-margin to-top"></span>
    </div>
    <div class="option-to-refresh-and-nex-to-style-order">
        <button class="option-to-table" title="Ver mas opciones del sistema" onclick="optionTablePlus()"><i class="fi fi-sr-circle-ellipsis-vertical"></i></button>
        <button class="counter-next" title="Es para gestionar pedidos en el mostrador" onclick="listTakeawayOrder()">Mostrador<i class="fi fi-br-angle-small-right"></i></button>
    </div>
</div>
@csrf
<div class="modify-estyle">
    <div class="sale-and-table">

        <div class="conteiner-table">
            <div class="tables-list" id="tables-list">

            </div>
        </div>
        <div class="list-delivery-order bottom-data">
            <div class="orders">
                <div class="header">
                    <div class="option-button-table-takeaway-multi">
                        <button class="button-option-table-oreder-takeaway order" title="Ordenes para entregar" onclick="listTakeawayOrder()"><i class="fi fi-sr-bell-concierge center-icon"></i></button>
                        <button class="button-option-table-oreder-takeaway status" title="Estado de ordenes pendientes" onclick="listOrdersPreparation()"><i class="fi fi-sr-grill center-icon"></i></button>
                        <button class="button-option-table-oreder-takeaway history" title="Historial de ordenes" onclick="listOrdersHistory()"><i class="fi fi-br-time-twenty-four center-icon"></i></button>
                    </div>
                    <div class="customer-finder-table">
                        <i class="fi fi-sr-member-search"></i>
                        <div class="col-3">
                            <input class="effect-1" type="text" id="search-data" placeholder="Buscar pedido">
                            <span class="focus-border"></span>
                        </div>
                    </div>

                </div>
                <table style="display: table">
                    <thead>
                        <tr>
                            <th>Nº Orden</i></th>
                            <th>Cliente</th>
                            <th>Tiempo</th>
                            <th id="type-of-payment">Pago</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody class="tr-td-key-point">


                    </tbody>

                </table>
                <div class="loader-data-not-client">
                    <div class="loader-table-search"></div>
                    <h1 class="not-data-search-client">No se encontro ningun resultado</h1>
                </div>
                <div class="pagination-container"></div>
            </div>

        </div>
    </div>
    <div class="edit-panel" id="puntoClave">

        <div class="text-select-direction sale-div">
            <div class="arrow top">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <samp class="span-select-table select-lounge">
                Seleccione una Sala <samp style="color: red">*</samp>
            </samp>
        </div>
        <div class="loader">
            <div class="loaderMiniContainer">
                <div class="barContainer">
                    <span class="bar"></span>
                    <span class="bar bar2"></span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 101 114" class="svgIcon">
                    <circle stroke-width="7" stroke="black" transform="rotate(36.0692 46.1726 46.1727)" r="29.5497" cy="46.1727" cx="46.1726"></circle>
                    <line stroke-width="7" stroke="black" y2="111.784" x2="97.7088" y1="67.7837" x1="61.7089"></line>
                </svg>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    const url = "{{ route('new_order_client') }}";
</script>
<script src="{{ asset($SearchBoxTemplate) }}"></script>
<script src="{{ asset($searchBoxDataCliene) }}"></script>
<script src="{{ asset($pointOfSale) }}"></script>
<script src="{{ asset($TableOrderTakeaway) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
