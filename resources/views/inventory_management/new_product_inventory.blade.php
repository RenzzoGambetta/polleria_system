<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InventoryRegisterMobile) }}">
<div class="header">
    <div class="left">
        <h1 class="title-reducer">Registro nuevo producto</h1>
        <ul class="breadcrumb">

            <a href="{{ route('inventory') }}" class="pagina">
                Inventario
            </a>
            <li>
                /
            </li>
            <a href="{{ route('show_panel_register_entry') }}" class="active">
                Nuevo producto
            </a>

        </ul>
    </div>
</div>

<form id="myForm" action="{{ route('register_product_entry') }}" method="POST">
    @csrf
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

                            <button type="button" class="option new-supplier" onclick="newSupplierRegistrationFast()">Registrar nuevo provedor . . .</button>
                        </div>

                        <div class="selected">Seleccionar un provedor</div>
                    </div>
                </div>
                <div class="lateralside-content sub-block-02">
                    <div class="input-group input-dimensions">
                        <input type="date" name="date" id="issue-date-input" class="input-iten effect-5 date-icon" placeholder=" " value="{{ date('Y-m-d') }}">
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
</form>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
