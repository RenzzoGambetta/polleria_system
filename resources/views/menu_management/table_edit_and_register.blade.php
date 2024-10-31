<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<script src="{{ $AlertSrc }}"></script>
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($TableEditAndRegister) }}">

<div class="header">
    <div class="left">
        <h1 id="title">Configuarcion de salas y mesas</h1>
    </div>
</div>
@csrf
<span class="limit-data"></span>
<div class="salas-conteiner">
    <div class="conteiner-salas-btn">
        <button class="scroll-btn left" onmousedown="startAutoScroll(-1, true)" onmouseup="stopAutoScroll()" onmouseout="stopAutoScroll()">‹</button>
        <div class="tabs-container" id="tabs-container">
            @foreach ($Lounge as $Lounges)
                <button class="button" id="button_{{ $Lounges->id }}" onclick="loadTableData({{ $Lounges->id }})">{{ $Lounges->name }}</button>
            @endforeach
        </div>
        <button class="scroll-btn right" onmousedown="startAutoScroll(1, true)" onmouseup="stopAutoScroll()" onmouseout="stopAutoScroll()">›</button>
    </div>
    <button class="add-room-btn" onclick="addLounges(null)"><i class="fi fi-bs-add"></i> Agregar sala</button>
</div>
<span class="limit-data limit-not-margin"></span>
<div class="conteiner-table">
    <div class="tables-list" id="tables-list">
        <div class="table-item" id="add-table-item">
            <div class="table-info">
                <i class="fi fi-bs-add table-add"></i>
                <span class="span-data-table">Añadir nueva mesa</span>
            </div>
        </div>
    </div>

    <div class="edit-panel" id="puntoClave">

    </div>

</div>
<script src="{{ asset($FunctionGlobal) }}"></script>
<script src="{{ asset($tableEditAndRegister) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
