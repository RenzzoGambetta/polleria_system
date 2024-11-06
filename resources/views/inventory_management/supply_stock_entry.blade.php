<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<script src="{{ $AlertSrc }}"></script>
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($InventoryRegisterMobile) }}">
<link rel="stylesheet" href="{{ asset($LoadFragment) }}">
<link rel="stylesheet" href="{{ asset($ItemSelectionAlert) }}">
<link rel="stylesheet" href="{{ asset($CheckboxAnimation) }}">
<link rel="stylesheet" href="{{ asset($SearchBox) }}">
<link rel="stylesheet" href="{{ asset($SupplyEntry) }}">

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

<form id="form-register-entry" action="{{ route('register_supply_entry') }}" method="POST">
    @csrf
    <div class="conteiner-principal">

        <div class="input-data-form">
            <div class="sub-input-01">
                @php

                    $comment = 'Comentario';

                @endphp
                <div class="block-01">
                    <div class="lateralside-content sub-block-01">

                        <div class="search-container">
                            <input type="number" id="id-supplier" name="supplier_id">
                            <input type="text" id="search-supplier" name="supplier_name" class="search-box-supplier input-iten effect-5 no-spinner alert-style" placeholder=" " autocomplete="off">
                            <label for="search-supplier" id="search-label-supplier" class="label-input-data mobile-label main-panel">Seleccione el provedor</label>
                            <div id="suggestions" class="suggestions-supplier"></div>
                            <div id="loader-supplier" class="loader-section">
                                <div class="loading">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="button-new-supplier" onclick="newSupplierRegistrationFast()">+</button>
                    </div>

                    <div class="lateralside-content sub-block-02">

                        <div class="select-document">
                            <div class="sub-title-div-document">
                                <label for="sub-title-select-01" class="sub-title-select-document">Documento</label>
                            </div>

                            <div class="options-document">

                                @foreach ($Voucher as $Type)
                                <label for="{{ $Type->name }}" class="option-document">
                                    <input type="radio" name="voucher_type_id" id="{{ $Type->name }}" value="{{ $Type->id }}" />
                                    <span>{{ $Type->name }}</span>
                                </label>
                                @endforeach
                            </div>

                            <div class="selected-document new-supply-select entry-data">Documento</div>
                        </div>

                        <div class="select-type-credit-and-cash">
                            <div class="sub-title-div-type">
                                <label for="sub-title-select-01" class="sub-title-select-type">Tipo</label>
                            </div>

                            <div class="options-type-credit-and-cash">
                                <label for="credit" class="option-type-credit-and-cash">
                                    <input type="radio" name="payment_type" id="credit" value="credito" />
                                    <span>Credito</span>
                                </label>
                                <label for="cash" class="option-type-credit-and-cash">
                                    <input type="radio" id="cash" name="payment_type" value="contado" />
                                    <span>Contado</span>
                                </label>
                            </div>

                            <div class="selected-type-credit-and-cash new-supply-select entry-data">Tipo</div>
                        </div>


                    </div>

                </div>

                <div class="block-02">

                    <div class="dub-block-001">
                        <div class="col-3 input-effect date-time">
                            <input type="date" name="issuance_date" id="dateTime" class="effect-16" placeholder=" " value="{{ date('Y-m-d') }}">
                            <label for="dateTime">Fecha de emision</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3 input-effect date-time">
                            <input type="date" name="expiration_date" id="dateTimeEnd" class="effect-16" placeholder=" ">
                            <label for="dateTimeEnd">Fecha de vencimiento</label>
                            <span class="focus-border"></span>
                        </div>
                    </div>
                    <div class="dub-block-002">
                        <div class="col-3 input-effect data-series">
                            <input type="text" name="voucher_serie" id="series" class="effect-16" placeholder=" " value="">
                            <label for="series">Serie</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3 input-effect data-numeric">
                            <input class="effect-16" type="text" name="correlative_numer" id="numeric" placeholder="" value="">
                            <label for="numeric">Numero</label>
                            <span class="focus-border"></span>
                        </div>

                    </div>

                </div>
            </div>
            <div class="input-data-form-numeric">
                <div class="wave-group input-dimensions comment">
                    <textarea class="input effect-4 comment" rows="5" cols="50" maxlength="500" name="commentary" id="comment-input" value="" placeholder=" "></textarea>
                    <label class="label">
                        @foreach (str_split($comment) as $index => $char)
                            <span style="--index: {{ $index }}" class="label-char">{{ $char }}</span>
                        @endforeach
                    </label>
                </div>

            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <table class="list-data-supply">
                    <thead>
                        <tr>
                            <th class="field-size movile-style-th">Producto</th>
                            <th class="data-entry movile-style-th">Unidad</th>
                            <th class="data-entry movile-style-th">C/Unitario</th>
                            <th class="data-entry movile-style-th">C/Total</th>
                            <th class="data-button movile-style-th">Opciones</th>

                        </tr>
                    </thead>

                    <tbody class="list-inten" id="puntoClave">
                        <td></td>
                        <td></td>
                        <td class="name-iten total-price-and-unit">Total -></td>
                        <td class="total-price-and-unit">
                            <div class="aling-center-displey">
                                <div class="text-aling-preci">s/<span id="total-price">0</span></div>
                            </div>
                        </td>
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
                        <div class="text" data-text="Esperando a que seleccione un provedor"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="options-button">
        <div class="sub-input-02">
            <button type="button" class="button-opcion-form cancel-option" onclick="cancelPage('{{ route('inventory') }}')"><i class="fi fi-sr-document-circle-wrong icon-option"></i>Cancelar</button>
            <button type="button" class="button-opcion-form clear-option border-style-right" onclick="clearInput()"><i class="fi fi-sr-broom icon-option"></i>Limpiar</button>
            <button type="button" class="button-opcion-form element-option" onclick="addItems()"><i class="fi fi-sr-add-document icon-option"></i>Añadir supplyo</button>
            <button type="submit" class="button-opcion-form register-option"><i class="fi fi-sr-registration-paper icon-option"></i>Registrar</button>
            <script src="{{ asset($FunctionButtonOnclick) }}"></script>

        </div>
    </div>
</form>
<script src="{{ asset($SearchBoxTemplate) }}"></script>
<script src="{{ asset($OptionSelector) }}"></script>
<script>
    const apiUrl = '/list_of_suppliers';
    new SearchBox('No se encuntro el provedor...', '.search-box-supplier', '#search-supplier', '#search-label-supplier', '.suggestions-supplier', '#loader-supplier', '#id-supplier', apiUrl, 5, 1);
    selectorItenandAnimation('selected-type-credit-and-cash', 'options-type-credit-and-cash', 'option-type-credit-and-cash', 'sub-title-div-type');
    selectorItenandAnimation('selected-document', 'options-document', 'option-document');

 </script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
