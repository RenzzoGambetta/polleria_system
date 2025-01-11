<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($ItemSelectionAlert) }}">
<link rel="stylesheet" href="{{ asset($galleryStyleImage) }}">

@csrf
<div class="container-option-select">
    <div class="tabs">
        <input type="radio" id="radio-1" name="tabs" value="supply" checked="">
        <label class="tab" for="radio-1">Suministros <i class="fi fi-sr-dolly-flatbed-alt icon-image-section"></i></label>
        <input type="radio" id="radio-2" name="tabs" value="item">
        <label class="tab" for="radio-2">Items <i class="fi fi-sr-plate-wheat icon-image-section"></i></label>
        <input type="radio" id="radio-3" name="tabs" value="combo">
        <label class="tab" for="radio-3">Combos <i class="fi fi-sr-crown icon-image-section"></i></label>
        <span class="glider"></span>
    </div>
</div>

<div class="image-container-primary">
    <div class="image-container-option-select">
    </div>
</div>

<!-- Fullscreen Overlay -->
<div id="overlay"></div>

<!-- Dropzone Form for Visual Effect -->
<div id="dropzone-area">
    <div class="dz-message" data-dz-message>
        <i class="fi fi-sr-add-image"></i>
        <span>¡Ya puedes dejar tu imagen aquí para guardarla!</span>
    </div>
</div>

<script src="{{ asset($GalleryQueryImage) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
