<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<script src="{{ $AlertSrc }}"></script>
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InventoryRegisterMobile) }}">

<div class="header">
    <div class="left">
        <h1 class="title-reducer">Registro de Entrada</h1>
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

<div class="input-data-form">
    <div class="sub-input-01">
        @php

            $comment = 'Comentario';

        @endphp
        <div class="block-01">
            <div class="lateralside-content sub-block-01">

                <div class="select">
                    <div class="sub-title-div">
                        <label for="sub-title-select-01" class="sub-title-select">Seleccione un provedor</label>

                    </div>
                    <div class="options">
                        @foreach ($Suppliers as $supplier)
                            <label for="{{ $supplier['id'] }}" class="option">
                                <input type="radio" name="supplier_id" id="{{ $supplier['id'] }}" value="{{ $supplier['id'] }}" />
                                <span>{{ $supplier['name'] }}</span>
                            </label>
                        @endforeach
                        <label for="new" class="option">
                            <input type="radio" name="role" id="new" />
                            <span>Nuevo provedor</span>
                        </label>
                    </div>

                    <div class="selected">Seleccionar un provedor</div>
                </div>
            </div>
            <div class="lateralside-content sub-block-02">
                <div class="input-group input-dimensions">
                    <input type="date" id="issue-date-input" class="input-iten effect-5 date-icon" placeholder=" " value="{{ date('Y-m-d') }}">
                    <label for="effect5">Fecha de emision</label>
                </div>
            </div>

        </div>
        <div class="block-02">
            <div class="wave-group input-dimensions comment">
                <textarea class="input effect-4 comment" rows="5" cols="50" maxlength="500" name="comment" id="comment-input" required=""></textarea>
                <label class="label">
                    @foreach (str_split($comment) as $index => $char)
                        <span style="--index: {{ $index }}" class="label-char">{{ $char }}</span>
                    @endforeach
                </label>
            </div>
        </div>

    </div>

</div>
<div class="bottom-data">
    <div class="orders">
        <table>
            <thead>
                <tr>
                    <th class="field-size movile-style-th">Producto</th>
                    <th class="data-entry movile-style-th">Precio</th>
                    <th class="data-entry movile-style-th">Cantidad</th>
                    <th class="data-button movile-style-th">Opciones</th>

                </tr>
            </thead>

            <tbody class="list-inten" id="puntoClave">
                <td class="name-iten total-price-and-unit">Total -></td>

                <td class="total-price-and-unit">
                    <div class="aling-center-displey">
                        <div class="text-aling-preci">s/<span id="total-price">0</span></div>
                    </div>
                </td>
                <td class="total-price-and-unit">
                    <div class="aling-center-displey">
                        <div class="text-aling-unit">Prd:<span class="double-space"> 0</span></div>
                    </div>
                </td>
            </tbody>

        </table>

    </div>
</div>
<div>
    <div class="sub-input-02">
        <button class="button-opcion-form cancel-option" onclick="cancelPage()"><i class="fi fi-sr-document-circle-wrong icon-option"></i>Cancelar</button>
        <button class="button-opcion-form clear-option" onclick="clearInput()"><i class="fi fi-sr-broom icon-option"></i>Limpiar</button>
        <button class="button-opcion-form element-option" onclick="addItems()"><i class="fi fi-sr-add-document icon-option"></i>Agregar un elemento</button>
        <button class="button-opcion-form register-option" onclick="prueba(1)"><i class="fi fi-sr-registration-paper icon-option"></i>Registrar</button>
        <script src="{{ asset($FunctionButtonOnclick) }}"></script>

    </div>
</div>
<script src="{{ asset($OptionSelector) }}"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
