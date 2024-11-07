<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<script src="{{ asset($AlertSrc) }}"></script>
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($TableEditAndRegister) }}">
<link rel="stylesheet" href="{{ asset($pointModify) }}">
<link rel="stylesheet" href="{{ asset($loaderOrder) }}">

@if (session()->has('Message'))
    <div class="container-aler">
        <div class="alert-error-and-response {{ session('Type') ?? 'error'}}">
            <div class="message-title-and-timer">
                <span class="tilte-alert">Mensaje:</span>
                <span class="sub-title-time" id="timer">{{ session('Time') ?? 10}}s</span>
            </div>
            <span class="text-alert">{{ session('Message')}}</span>
        </div>
    </div>
    <script>
        timeAlert({{ session('Time') ?? 10}})
    </script>
@endif

<div class="header">
    <div class="left">
        <h1 id="title">Punto de Venta</h1>
    </div>
</div>
@csrf
<div class="modify-estyle">
    <div class="sale-and-table">
        <span class="limit-data"></span>
        <div class="salas-conteiner">
            <div class="conteiner-salas-btn">
                <button class="scroll-btn left" onmousedown="startAutoScroll(-1, true)" onmouseup="stopAutoScroll()" onmouseout="stopAutoScroll()">‹</button>
                <div class="tabs-container" id="tabs-container">
                    @foreach ($Lounge as $Lounges)
                        <button class="button" id="button_{{ $Lounges->id }}" onclick="loadTableData({{ $Lounges->id }},'{{ $Lounges->name }}')">{{ $Lounges->name }}</button>
                    @endforeach
                </div>
                <button class="scroll-btn right" onmousedown="startAutoScroll(1, true)" onmouseup="stopAutoScroll()" onmouseout="stopAutoScroll()">›</button>
            </div>
        </div>
        <span class="limit-data limit-not-margin"></span>
        <div class="conteiner-table">
            <div class="tables-list" id="tables-list">

            </div>
        </div>
    </div>

    <div class="edit-panel" id="puntoClave">
        <div class="text-select-direction sale-div">
            <div class="arrow">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <samp class="span-select-table">
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


<script src="{{ asset($pointOfSale) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
