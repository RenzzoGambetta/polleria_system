<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($SearchBox) }}">
<link rel="stylesheet" href="{{ asset($ItemSelectionAlert) }}">
<link rel="stylesheet" href="{{ asset($MenuRegisterAndEdit) }}">
<link rel="stylesheet" href="{{ asset($galleryStyleImageAlert) }}">
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
        <h1 id="title">{{ $Data['Title'] }}</h1>
    </div>
</div>
<form id="myForm -  " action="{{ $Data['Toggle'] ? route('register_new_menu') : route('edit_new_menu') }}" method="get">
    @csrf
    @if ($Data['Toggle'])
        <div class="actio-register-and-edit">
            <div class="radio-input">
                <label>
                    <input value="0" name="is_combo" id="value-1" type="radio" @checked($Data['button_type'] == 2 || $Data['button_type'] == 3)
                        onchange="handleRadioChange(event)" />
                    <span>Bebida o plato</span>
                </label>
                <label>
                    <input value="1" name="is_combo" id="value-2" type="radio" @checked($Data['button_type'] == 1)
                        onchange="handleRadioChange(event)" />
                    <span>Combo</span>
                </label>
                <span class="selection"></span>
            </div>
        </div>
    @endif
    <div class="new-register-item">
        @php

            $comment = 'Comentario';

        @endphp
        @if (!empty($ComboItem) && !empty($ComboItem->id))
            <input type="hidden" name="id" value="{{ $ComboItem->id }}">
            <input type="hidden" name="is_combo" value="{{ $ComboItem->is_combo }}">

            <script>
                var id = {{ $ComboItem->id ?? 'null' }};
                var combo = {{ $ComboItem->is_combo ?? 'null' }};
            </script>
        @endif

        @if ($ComboItem->is_combo ?? 0 == 1)
            <script>
                const apiUrl = '/list_of_item';
            </script>
        @else
            <script>
                const apiUrl = '/list_of_supplys';
            </script>
        @endif
        <div class="conteiner-new-supply">
            <div class="conteiner-01">
                <div class="frame-01">

                    <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">

                        <div class="input-group input-dimensions alert-style-div-input alert-input">
                            <input type="text" id="name-data" name="name"
                                class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" "
                                value="{{ $ComboItem->name ?? '' }}">
                            <label for="name-data" class="label-input-data mobile-label">Nombre</label>
                        </div>
                        <div class="input-group input-dimensions alert-style-div-input alert-input">
                            <input type="number" step=".01" id="code-data" name="price"
                                class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" "
                                value="{{ $ComboItem->price ?? '' }}">
                            <label for="code-data" class="label-input-data mobile-label">Precio</label>
                        </div>
                    </div>

                    <div class="input-data-number">
                        <div class="wave-group input-dimensions comment">
                            <textarea class="input effect-4 comment" rows="5" cols="50" maxlength="500" name="comment" id="comment-input"
                                value="" placeholder=" "></textarea>
                            <label class="label">
                                @foreach (str_split($comment) as $index => $char)
                                    <span style="--index: {{ $index }}"
                                        class="label-char">{{ $char }}</span>
                                @endforeach
                            </label>
                        </div>
                    </div>
                </div>
                <div class="frame-02" id="drop-frame">
                    <label class="custum-file-upload" id="drop-area">
                        <div class="custum-file-upload-container">
                            <div class="icon" id="icon-preview">
                                <i class="fi fi-br-add-image icon-image-foro icon-primary"></i>
                            </div>
                            <div class="text" id="text-preview">
                                <span id="text-image">Subir una imagen</span>
                            </div>
                        </div>
                    </label>
                    <div class="hover-buttons">
                        <button class="btn left" type="button" onclick="document.getElementById('file').click();">
                            <i class="fi fi-sr-cloud-upload icon-image-foro"></i> Subir imagen
                        </button>
                        <button class="btn right" type="button" id="LoadImage" onclick="showImages()">
                            <i class="fi fi-sr-gallery icon-image-foro"></i> Seleccionar imagen 
                        </button>
                    </div>
                </div>
                <input id="file" type="file" accept="image/*" onchange="previewImage(event)" style="display:none;" name="image" value="{{ old('image', $Supply->image ?? '') }}">
                <input id="imageURL" type="text" name="imageURL" value="{{ old('imageURL', $Supply->image_url ?? '') }}" style="display:none;">
            </div>
            <div class="conteiner-02">
                <div class="frame-01-conteiner-02">
                    <div class="menu-item-combo">
                        <div class="title-combo">
                            <h1 class="h1-title-combo" id="sub-title">{{ $Data['SubTitle'] }}</h1>
                        </div>
                        <div class="combo-sect-product-and-quantity">
                            <div class="search-container sub-frame-01">
                                <input type="number" id="id-item" name="id_item_name">
                                <input type="text" id="search" name="item_name" class="effect-16"
                                    placeholder=" " autocomplete="off">
                                <label for="search" id="search-label">{{ $Data['Input'] }}</label>
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
                                <input class="effect-16 quantity-data-input" type="number" step=".01"
                                    name="quantity" id="quantity" placeholder=" "
                                    title="Coloca la cantidad que se usa o ofrese">
                                <label for="quantity">Cantidad</label>
                                <span class="focus-border"></span>
                            </div>
                            <div class="new-item">
                                <a href="#1" id="add-combo">+</a>
                            </div>
                        </div>
                        <span class="limit-data"></span>
                        <div class="conteiner-etiker"></div>
                        <div class="hidden-inputs-container"></div>
                    </div>
                </div>

                <div class="frame-02-conteiner-02">
                    <div class="price-and-quantity">
                        <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">

                            <div class="search-container categort-conteiner">
                                <input type="number" id="id-category" name="category_id"
                                    value="{{ $ComboItem->category_id ?? '' }}{{ $Data['idCategory'] ?? '' }}">
                                <input type="text" id="search-category" name="category_name"
                                    class="search-box input-iten effect-5 no-spinner alert-style search-category"
                                    placeholder=" " autocomplete="off"
                                    value="{{ $ComboItem->category->name ?? '' }}{{ $Data['nameCategory'] ?? '' }}">
                                <label for="search-category" id="search-label-category"
                                    class="label-input-data mobile-label">Categoria</label>
                                <div id="suggestions" class="suggestions-category"></div>
                                <div id="loader-category" class="loader-section">
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
                    </div>
                    <div class="cooking-place">
                        <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">

                            <div class="search-container categort-conteiner">
                                <input type="number" id="id-cooking-place" name="cooking_place_id"
                                    value="{{ $ComboItem->cooking_place_id ?? '' }}">
                                <input type="text" id="search-cooking-place" name="cooking_place_name"
                                    class="search-box input-iten effect-5 no-spinner alert-style search-cooking-place"
                                    placeholder=" " autocomplete="off" value="">
                                <label for="search-cooking-place" id="search-label-cooking-place"
                                    class="label-input-data mobile-label">Lugar preparacion</label>
                                <div id="suggestions" class="suggestions-cooking-place"></div>
                                <div id="loader-cooking-place" class="loader-section">
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
                    </div>
                    <div class="btn-navegation">
                        <button type="button" class="btn-action-cancel"
                            onclick="urlGet('{{ route($Data['UrlCancel']) }}{{ $Data['UrlComplement'] ?? '' }}')">Cancelar</button>
                        <button type="submit"
                            class="{{ $Data['Toggle'] ? 'btn-action-register' : 'btn-action-edit' }}">{{ $Data['Toggle'] ? 'Agregar' : 'Editar' }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Fullscreen Overlay -->
<div id="overlay"></div>

<!-- Dropzone Form for Visual Effect -->
<div id="dropzone-area">
    <div class="dz-message" data-dz-message>
        <i class="fi fi-sr-add-image"></i>
        <span>¡Ya puedes dejar tu imagen aquí para guardarla!</span>
    </div>
</div>

<!-- Muestra los errores de validación -->
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<script src="{{ asset($SearchBoxTemplate) }}"></script>
<script src="{{ asset($OptionSelector) }}"></script>
<script src="{{ asset($newLabelData) }}"></script>
<script src="{{ asset($newMenuAndEdit) }}"></script>
<script src="{{ asset($newActionImage) }}"></script>
<script>
    new SearchBox('No se encuntra la area...', '.search-cooking-place', '#search-cooking-place',
        '#search-label-cooking-place', '.suggestions-cooking-place', '#loader-cooking-place', '#id-cooking-place',
        '/list_of_cooking_place', 5, 0);
</script>
@if (isset($Data['button_type']) && $Data['button_type'] == 1)
    <script>
        dataSelevtValue(1);
    </script>
@elseif (isset($Data['button_type']) && ($Data['button_type'] == 2 || $Data['button_type'] == 3))
    <script>
        dataSelevtValue(0);
    </script>
@endif

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
