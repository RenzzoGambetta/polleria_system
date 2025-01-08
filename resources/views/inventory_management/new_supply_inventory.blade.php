<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InventoryRegisterMobile) }}">
<link rel="stylesheet" href="{{ asset($ItemSelectionAlert) }}">
<link rel="stylesheet" href="{{ asset($CheckboxAnimation) }}">
<link rel="stylesheet" href="{{ asset($RegisterNewsupply) }}">

@if (session()->has('Message'))
    <div class="container-aler">
        <div class="alert-error-and-response {{ session('Type') ?? 'error' }}">
            <div class="message-title-and-timer">
                <span class="tilte-alert">Mensaje:</span>
                <span class="sub-title-time" id="timer">{{ session('Time') ?? 10 }}s</span>
            </div>
            <span class="text-alert">{{ session('Message') }}</span>
        </div>
    </div>
    <script>
        timeAlert({{ session('Time') ?? 10 }})
    </script>
@endif

<div class="header">
    <div class="left">
        <h1 class="title-reducer">{{ $Supply['title'] }}</h1>
        <ul class="breadcrumb">

            <a href="{{ route('inventory') }}" class="pagina">
                Inventario
            </a>
            <li>
                /
            </li>
            <a href="{{ route('new_supply_inventory') }}" class="active">
                Nuevo suministro
            </a>

        </ul>
    </div>
</div>
@php

    $comment = 'Comentario';

@endphp
<form id="myForm" action="{{ route('register_new_supply_complete') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="conteiner-new-supply">
        <div class="conteiner-01">
            <div class="frame-01">

                <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">
                    <div class="input-group input-dimensions alert-style-div-input alert-input">
                        <input type="text" id="name-data" name="name" class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" " value="{{ old('name', $Supply->name ?? '') }}">
                        <label for="name-data" class="label-input-data mobile-label">Nombre</label>
                    </div>
                    <div class="input-group input-dimensions alert-style-div-input alert-input">
                        <input type="text" id="brand_name-data" name="brand_name" class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" " value="{{ old('brand_name', $Supply->brandName ?? '') }}">
                        <label for="brand_name-data" class="label-input-data mobile-label">Marca</label>
                    </div>
                </div>

                <div class="input-data-number">
                    <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">
                        <div class="input-group input-dimensions alert-style-div-input alert-input">
                            <input type="text" id="code-data" name="code" class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" " value="{{ old('code', $Supply->code ?? '') }}">
                            <label for="code-data" class="label-input-data mobile-label">Codigo</label>
                        </div>
                    </div>
                    <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">
                        <div class="select-unit-of-measurement-supply-new">
                            <div class="sub-title-div">
                                <label for="sub-title-select-01" class="sub-title-select">Unidad medida</label>
                            </div>
                            <div class="options-unit-of-measurement-supply-new">
                                @foreach ($UnitOptions as $unit)
                                    <label for="{{ $unit[0] }}" class="option-unit-of-measurement-supply-new">
                                        <input type="radio" name="unit" id="{{ $unit[0] }}" value="{{ $unit[0] }}" />
                                        <span>{{ $unit[1] }}.</span>
                                    </label>
                                @endforeach
                            </div>

                            <div class="selected-unit-of-measurement-supply-new new-supply-select">Selecciona una medida</div>
                        </div>
                    </div>
                </div>
                <div class="input-data-number">
                    <div class="lateralside-content sub-block-02 alert-style-div heigh-div-input">
                        <div class="checkbox-wrapper-35">
                            <input name="is_stockable" id="switch-data" type="checkbox" class="switch" {{ old('is_stockable', $Supply->is_stockable ?? '') == 1 ? 'checked' : '' }}>
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
                            @if ($Supply->isEdit ?? false)
                                <input type="number" id="stock-data" name="stock" class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" " value="{{ old('stock', $Supply->stock ?? '') }}" min="0">
                            @else
                                <input type="number" id="stock-data" name="stock" class="input-iten effect-5 no-spinner date-icon alert-style" placeholder=" " value="{{ old('stock', $Supply->stock ?? '') }}" disabled min="0">
                            @endif
                            <label for="stock-data" class="label-input-data mobile-label">Stock</label>
                        </div>
                    </div>
                </div>
                <div class="buttom-select">
                    @if ($Supply->isEdit ?? false)
                        <script>
                            const OptionId = '{{ $Supply->unit }}';
                        </script>
                        <input type="text" name='id_edit_stock' value="{{ $Supply->id }}" style="display: none">
                        <button type="button" class="button-option-new-supply cancel-btn" onclick="urlGet('{{ route('delete_new_supply_complete') }}',{id:{{ $Supply->id }}})">Eliminar</button>
                        <button type="submit" class="button-option-new-supply register-or-edit">Editar</button>
                    @else
                        <script>
                            const OptionId = null;
                        </script>
                        <button type="button" class="button-option-new-supply cancel-btn" onclick="exit()">Cancelar</button>
                        <button type="submit" class="button-option-new-supply register-or-edit">Registrar</button>
                    @endif
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

        </div>
        <div class="conteiner-02">
            <div class="input-data-form-numeric">
                <div class="wave-group input-dimensions comment">
                    <textarea class="input effect-4 comment" rows="5" cols="50" maxlength="500" name="note" id="comment-input" value="" placeholder=" ">{{ old('note', $Supply->note ?? '') }}</textarea>
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
<script src="{{ asset($NewSupplyAction) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
