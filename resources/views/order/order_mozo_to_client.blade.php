<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderMozo)
<!---------------------------------------------------------------------->
<script src="{{ asset($AlertSrc) }}"></script>
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($pointModify) }}">
<link rel="stylesheet" href="{{ asset($TableMozoPanel) }}">
<link rel="stylesheet" href="{{ asset($newOrder) }}">
<link rel="stylesheet" href="{{ asset($orderReceptionToClient) }}">
@csrf

<div class="container-order-client">
    <button class="open-details-btn" onclick="toggleTableDetails()"><i class="fi fi-sr-shopping-cart-add icon-center"></i></button>
    <div class="table-details-panel" id="tableDetailsPanel">
        <div class="container-table-data">
            <div class="table-data">
                <div class="header-table-data">
                    <button class="close-details-btn" onclick="toggleTableDetails()"><i class="fi fi-sr-angle-double-small-left icon-center"></i> <span class="spam-icon-left">Retroseder</span></button>
                    <button class="icon-table" title="Asignar datos del cliente"><i class="fi fi-ss-user-pen center-icon"></i> Datos</button>
                </div>
                <div id="data-item-client">
                   

                </div>
            </div>
            <div class="footer-total">
                <span id="price-item-data-total-product">s/ 16</span>
                
                <div class="button-container">
                    <button class="button-commentary" onclick="noteDetailOrder()">
                        <i class="fi fi-ss-memo center-icon icon-center"></i>
                    </button>
                    <button class="continue-button" onclick="sendSegmentedData()">
                        Enviar Orden
                        <i class="fi fi-sr-paper-plane-top icon-center"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="category-type-data">
    <div class="frame-nav-option" id="button-categori-display">
        <div class="sub-title-cetgory category">
            <span id="sub-title-category-text">Categorias</span>
            <i class="fi fi-sr-angle-small-down center-icon" id="icon-efect-to-category"></i>
        </div>
    </div>
    <div class="frame-category-option" id="frame-category-data">
        @foreach ($Category as $item)
            <div class="tables-list">
                <div class="table-item" id="lounge_{{ $item->id }}" x:name="{{ $item->name }}">
                    <div class="table-info">
                        <span class="span-data-table">{{ $item->name }}</span>
                        <i class="fi fi-rr-angle-right table-add"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="category-product-type-data">
    <div class="frame-nav-option" style="display: none">
        <div class="sub-title-cetgory">
            <span>Sub categorias</span>
            <i class="fi fi-sr-angle-small-down center-icon"></i>
        </div>
    </div>
    <script>
        const items = @json($Items);
        const id_lounge = {{$Option['lounge_id']}};
        const id_table = {{$Option['id_table']}};

    </script>
    <div class="frame-category-option" id="item-container-select-to-category" style="display: none;">

    </div>
</div>
<script src="{{ asset($orderReceptionMozo) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
