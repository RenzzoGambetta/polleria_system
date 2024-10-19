<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<script src="{{ $AlertSrc }}"></script>
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">

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


    </div>
    <script>
        //$(document).ready(function() {
        //    newSupplierRegistrationFast()
        //});
    </script>
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

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
