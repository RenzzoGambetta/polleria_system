<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderMozo)
<!---------------------------------------------------------------------->
<script src="{{ asset($AlertSrc) }}"></script>
<link rel="stylesheet" href="{{ asset($TableEditAndRegister) }}">
<link rel="stylesheet" href="{{ asset($pointModify) }}">
<link rel="stylesheet" href="{{ asset($TableMozoPanel) }}">

<div class="header">
    <div class="left">
        <h1 id="title">{{ $Option['lounge_name'] }}</h1>
    </div>
</div>
<div class="tables-list-tomozo" id="tables-list">

    @foreach ($Tables as $Table)
        <div class="table-item table-data" style="background-color:#{{ $Table->status == 1 ? 'f95f5f85' : '26f9276e' }};" data-id="{{ $Table->id }}">
            <i class="fi fi-sr-order-history"></i>
            <div class="container-secription-table">
                <div class="table-info data-info-table-sub-name">
                    <span class="span-data">Mesa</span><span class="span-data-table" id="spma_{{ $Table->id }}">{{ $Table->code }}</span>
                </div>
                <span class="status"><i class="fi fi-rr-angle-right"></i></span>
            </div>
            <div class="time-table-client" style="display:{{ $Table->status == 1 ? 'block' : 'none' }};">
                <i class="fi fi-br-time-forward"></i>
                <span>19 min</span>
            </div>
            <span style="display: none;" id="status" data-id="{{ $Table->status }}"></span>
        </div>
    @endforeach
</div>

<script src="{{ asset($tableMozoPanelFuction) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
