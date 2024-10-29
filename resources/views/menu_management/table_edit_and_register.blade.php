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

        <div class="table-item table-data">
            <div class="table-info">
                <i class="fi fi-ss-trash"></i>
                <span class="span-data-table">Mesa 1</span>
            </div>
            <span class="status"><i class="fi fi-rr-angle-right"></i></span>
        </div>
    </div>

    <div class="edit-panel" id="puntoClave">

    </div>

</div>
<script src="{{ asset($FunctionGlobal) }}"></script>
<script src="{{ asset($tableEditAndRegister) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
<!--
     <h3>Registrar sala</h3>
        <label for="room-name">Nombre de la sala <samp class="mandatory-sign">*</samp></label>
        <input type="text" id="room-name" placeholder="Salón" name="nameLounge" value="">

        <label for="room-name">Direccion <samp class="mandatory-sign">*</samp></label>
        <input type="text" id="room-name" placeholder="Salón" name="addressLounge" value="">

        <div class="div-compact">
            <div class="frame-div">
                <label for="room-name">Codigo <samp class="mandatory-sign">*</samp></label>
                <input type="text" id="room-name" placeholder="Salón" name="codeLounge" value="">
            </div>
            <div class="frame-div">
                <label for="room-name">Priso <samp class="mandatory-sign">*</samp></label>
                <input type="text" id="room-name" placeholder="Salón" name="floorLounge" value="">
            </div>
        </div>
        <input type="number" style="display: none;" name="idLounge" value="0">
        <button class="btn-new" onclick="newLoungeAction()">Agregar</button>
-->
