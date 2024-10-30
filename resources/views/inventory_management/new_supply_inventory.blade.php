<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InventoryRegisterMobile) }}">
<link rel="stylesheet" href="{{ asset($ItemSelectionAlert) }}">
<link rel="stylesheet" href="{{ asset($CheckboxAnimation) }}">
<link rel="stylesheet" href="{{ asset($RegisterNewsupply) }}">

<div class="header">
    <div class="left">
        <h1 class="title-reducer">Registro nuevo suministro</h1>
        <ul class="breadcrumb">

            <a href="{{ route('inventory') }}" class="pagina">
                Inventario
            </a>
            <li>
                /
            </li>
            <a href="{{ route('show_panel_register_entry') }}" class="active">
                Nuevo supplyo
            </a>

        </ul>
    </div>
</div>
@php

    $comment = 'Comentario';

@endphp
<form id="myForm" action="{{ route('register_supply_entry') }}" method="POST">
    @csrf
    <div class="conteiner-new-supply">
        <div class="conteiner-01">
            <div class="frame-01">

                <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">
                    <div class="input-group input-dimensions alert-style-div-input alert-input">
                        <input type="text" id="name-data" name="name" class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" ">
                        <label for="name-data" class="label-input-data mobile-label">Nombre</label>
                    </div>
                </div>

                <div class="input-data-number">
                    <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">
                        <div class="input-group input-dimensions alert-style-div-input alert-input">
                            <input type="number" id="code-data" name="code" class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" ">
                            <label for="code-data" class="label-input-data mobile-label">Codigo</label>
                        </div>
                    </div>
                    <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">
                        <div class="select-unit-of-measurement-supply-new">
                            <div class="sub-title-div">
                                <label for="sub-title-select-01" class="sub-title-select">Unidad medida</label>
                            </div>
                            <div class="options-unit-of-measurement-supply-new">
                                <label for="kg" class="option-unit-of-measurement-supply-new">
                                    <input type="radio" name="measurement_system" id="kg" value="kg" />
                                    <span> kilo.</span>
                                </label>
                                <label for="g" class="option-unit-of-measurement-supply-new">
                                    <input type="radio" id="g" name="measurement_system" value="g" />
                                    <span>gramo.</span>
                                </label>
                                <label for="l" class="option-unit-of-measurement-supply-new">
                                    <input type="radio" id="l" name="measurement_system" value="l" />
                                    <span>litro.</span>
                                </label>
                                <label for="ml" class="option-unit-of-measurement-supply-new">
                                    <input type="radio" id="ml" name="measurement_system" value="ml" />
                                    <span>mililitro.</span>
                                </label>
                                <label for="ud" class="option-unit-of-measurement-supply-new">
                                    <input type="radio" id="ud" name="measurement_system" value="ud" />
                                    <span>unidad.</span>
                                </label>
                            </div>

                            <div class="selected-unit-of-measurement-supply-new new-supply-select">Selecciona una medida</div>
                        </div>
                    </div>
                </div>
                <div class="input-data-number">
                    <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">
                        <div class="checkbox-wrapper-35">
                            <input name="is_stock" id="switch-data" type="checkbox" class="switch" value="true" checked>
                            <label for="switch-data">
                                <span class="switch-x-toggletext">
                                    <span class="switch-x-unchecked"><span class="switch-x-hiddenlabel">Unchecked:
                                        </span>No </span>
                                    <span class="switch-x-checked"><span class="switch-x-hiddenlabel">Checked:
                                        </span>Si</span>
                                </span>
                                <span class="switch-x-text">es estoqueable!</span>
                            </label>
                        </div>

                    </div>
                    <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">
                        <div class="input-group input-dimensions alert-style-div-input alert-input">
                            <input type="number" id="stock-data" name="stock" class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" ">
                            <label for="stock-data" class="label-input-data mobile-label">Stock</label>
                        </div>
                    </div>
                </div>
                <div class="buttom-select">
                    <button type="button" class="button-option-new-supply cancel-btn" onclick="exit()">Cancelar</button>
                    <button type="submit" class="button-option-new-supply register-or-edit">Registrar</button>
                </div>
            </div>
            <div class="frame-02">
                <label for="file" class="custum-file-upload">
                    <div class="icon" id="icon-preview">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                    fill=""></path>
                            </g>
                        </svg>
                    </div>
                    <div class="text" id="text-preview">
                        <span>Subir una imagen</span>
                    </div>
                    <input id="file" type="file" accept="image/*" onchange="previewImage(event)" style="display:none;">
                </label>

            </div>
        </div>
        <div class="conteiner-02">
            <div class="input-data-form-numeric">
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
</form>
<script src="{{ asset($OptionSelector) }}"></script>
<script src="{{ asset($NewsupplyAction) }}"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>