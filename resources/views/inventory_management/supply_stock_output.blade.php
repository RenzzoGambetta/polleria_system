<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<script src="{{ $AlertSrc }}"></script>
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($LoadFragment) }}">
<link rel="stylesheet" href="{{ asset($SearchBox) }}">
<link rel="stylesheet" href="{{ asset($OuputSupply) }}">

<div class="header">
    <div class="left">
        <h1 class="title-reducer">Registro de Salida</h1>
        <ul class="breadcrumb">

            <a href="{{ route('inventory') }}" class="pagina">
                Inventario
            </a>
            <li>
                /
            </li>
            <a href="{{ route('show_panel_register_entry') }}" class="active">
                Registro
            </a>

        </ul>
    </div>
</div>
@php

    $comment = 'Razon';

@endphp
<form id="form-register-output" action="{{ route('register_supply_entry') }}" method="POST">
    @csrf
    <div class="output-supply-01">
        <div class="output-supply-sub-01">
            <div class="frame-01">
                <div class="sub-frame-01">
                    <div class="search-container">
                        <input type="number" id="id-supply" name="id_supply_name">
                        <input type="text" id="search" name="supply_name" class="search-box input-iten effect-5 no-spinner alert-style" placeholder=" " autocomplete="off">
                        <label for="search" id="search-label" class="label-input-data mobile-label">Producto</label>
                        <div id="suggestions" class="suggestions"></div>
                        <div id="loader" class="loader-section">
                            <div class="loading">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-frame-02">
                    <button type="button" class="btn-output-supply-item" onclick="addSupply()"><i class="fi fi-br-plus"></i></button>
                </div>
            </div>
            <div class="frame-02">
                <div class="sub-frame-001">
                    <button type="button" class="btn-cancel-action-output">Cancelar</button>
                    <button type="submit" class="btn-register-action-output">Registrar</button>
                </div>
            </div>
        </div>
        <div class="output-supply-sub-02">
            <div class="frame-001">
                <div class="wave-group input-dimensions comment">
                    <textarea class="input effect-4 comment" rows="5" cols="50" maxlength="500" name="comment" id="comment-input" value="" placeholder=" "></textarea>
                    <label class="label">
                        @foreach (str_split($comment) as $index => $char)
                            <span style="--index: {{ $index }}" class="label-char">{{ $char }}</span>
                        @endforeach
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="output-supply-02">
        <div class="bottom-data">
            <div class="orders">
                <table class="list-data-supply">
                    <thead>
                        <tr>
                            <th class="field-size movile-style-th">Producto</th>
                            <th class="data-entry movile-style-th">Unidad</th>
                            <th class="data-entry movile-style-th">C/Unitario</th>
                            <th class="data-entry movile-style-th">Unidad medida</th>
                            <th class="data-entry movile-style-th">Sub Total</th>
                            <th class="data-button movile-style-th">Opciones</th>

                        </tr>
                    </thead>

                    <tbody class="list-inten" id="puntoClave">
                        
                    </tbody>

                </table>
                <div class="filter">
                    <div id="wifi-loader">
                        <svg class="circle-outer" viewBox="0 0 86 86">
                            <circle class="back" cx="43" cy="43" r="40"></circle>
                            <circle class="front" cx="43" cy="43" r="40"></circle>
                            <circle class="new" cx="43" cy="43" r="40"></circle>
                        </svg>
                        <svg class="circle-middle" viewBox="0 0 60 60">
                            <circle class="back" cx="30" cy="30" r="27"></circle>
                            <circle class="front" cx="30" cy="30" r="27"></circle>
                        </svg>
                        <svg class="circle-inner" viewBox="0 0 34 34">
                            <circle class="back" cx="17" cy="17" r="14"></circle>
                            <circle class="front" cx="17" cy="17" r="14"></circle>
                        </svg>
                        <div class="text" data-text="Esperando un producto"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</form>
<script src="{{ asset($SearchBoxTemplate) }}"></script>
<script src="{{ asset($FuctionButtonOutput) }}"></script>
<script>
    const apiUrl = '/list_of_supplys';
    new SearchBox('No se encuntro el Producto...', '.search-box', '#search', '#search-label', '.suggestions', '#loader', '#id-supply', apiUrl, 5, 0);
</script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
