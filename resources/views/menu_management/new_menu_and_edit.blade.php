<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($SearchBox) }}">
<link rel="stylesheet" href="{{ asset($ItemSelectionAlert) }}">
<link rel="stylesheet" href="{{ asset($MenuRegisterAndEdit) }}">

<div class="header">
    <div class="left">
        <h1>Nuevo Iten</h1>
    </div>
</div>

@csrf
<div class="actio-register-and-edit">
    <div class="radio-input">
        <label>
            <input value="value-1" name="value-radio" id="value-1" type="radio" checked />
            <span>Bebida o plato</span>
        </label>
        <label>
            <input value="value-2" name="value-radio" id="value-2" type="radio" />
            <span>Combo</span>
        </label>
        <span class="selection"></span>
    </div>
</div>
<div class="new-register-item">
    @php

        $comment = 'Comentario';

    @endphp

    <div class="conteiner-new-supply">
        <div class="conteiner-01">
            <div class="frame-01">

                <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">


                    <div class="input-group input-dimensions alert-style-div-input alert-input">
                        <input type="text" id="name-data" name="name" class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" ">
                        <label for="name-data" class="label-input-data mobile-label">Nombre</label>
                    </div>
                    <div class="input-group input-dimensions alert-style-div-input alert-input">
                        <input type="number" id="code-data" name="code" class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" ">
                        <label for="code-data" class="label-input-data mobile-label">Precio</label>
                    </div>
                </div>

                <div class="input-data-number">
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
            <div class="frame-01-conteiner-02">
                <div class="menu-item-combo">
                    <div class="title-combo">
                        <h1 class="h1-title-combo">Conjunto que conforma un Combo</h1>
                    </div>
                    <div class="combo-sect-product-and-quantity">
                        <div class="search-container sub-frame-01">
                            <input type="number" id="id-supply" name="id_supply_name">
                            <input type="text" id="search" name="supply_name" class="effect-16" placeholder=" " autocomplete="off">
                            <label for="search" id="search-label">Producto</label>
                            <span class="focus-border"></span>
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

                        <div class="icon-product-and-quantity">
                            <i class="fi fi-rr-exchange-alt"></i>
                        </div>
                        <div class="col-3 input-effect data-numeric">
                            <input class="effect-16 quantity-data-input" type="numeric" name="numeric" id="numeric" placeholder="" value="">
                            <label for="numeric">Cantidad</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="new-item">
                            <a href="#1">+</a>
                        </div>
                    </div>
                    <span class="limit-data"></span>
                </div>
            </div>
            <div class="frame-02-conteiner-02">
                <div class="price-and-quantity">
                    <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">

                        <div class="input-group input-dimensions alert-style-div-input alert-input">
                            <input type="number" id="price-data" name="price" class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" ">
                            <label for="price-data" class="label-input-data mobile-label">Precio</label>
                        </div>


                    </div>
                </div>
                <div class="btn-navegation">
                    <button type="submit" class="btn-action-cancel">Cancelar</button>
                    <button type="button" class="btn-action-register">Agregar</button>
                </div>

            </div>
        </div>

    </div>
</div>
<script src="{{ asset($SearchBoxTemplate) }}"></script>
<script src="{{ asset($OptionSelector) }}"></script>
<script>
    const apiUrl = '/list_of_supplys';
    new SearchBox('No se encuntro el Producto...', '.search-box', '#search', '#search-label', '.suggestions', '#loader', '#id-supply', apiUrl, 5, 0);
</script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
