<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<script src="{{ $AlertSrc }}"></script>
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">

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
            $data = 'Datos';

        @endphp
        <div class="block-01">
            <div class="lateralside-content">

                <div class="select">
                    <div class="sub-title-div">
                        <label for="sub-title-select-01" class="sub-title-select">Seleccione un provedor</label>

                    </div>
                    <div class="options">
                        <label for="uiux" class="option">
                            <input type="radio" name="role" id="uiux" />
                            <span> UI/UX Engineer</span>
                        </label>

                        <label for="frontend" class="option">
                            <input type="radio" id="frontend" name="role" />
                            <span>Frontend Engineer</span>
                        </label>

                        <label for="backend" class="option">
                            <input type="radio" id="backend" name="role" />
                            <span>Backend Engineer</span>
                        </label>
                    </div>

                    <div class="selected">Seleccionar un provedor</div>
                </div>
            </div>
            <div class="lateralside-content">
                <div class="input-group input-dimensions">
                    <input type="date" id="issue-date-input" class="input-iten effect-5" placeholder=" " value="{{ date('Y-m-d') }}">
                    <label for="effect5">Fecha de emision</label>
                </div>

                <div class="wave-group input-dimensions">
                    <input class="input effect-4" type="text" name='data' id="data-input" required="" />
                    <label class="label">
                        @foreach (str_split($data) as $index => $char)
                            <span style="--index: {{ $index }}" class="label-char">{{ $char }}</span>
                        @endforeach
                    </label>
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
                    <th>Nº</th>
                    <th>Data</th>
                    <th>Data</th>
                    <th>Data</th>
                    <th>Data</th>
                </tr>
            </thead>
            @foreach ($Productos as $item)
                <tbody>

                    <td>{{ $item ->id }}</td>
                    <td>{{ $item ->name }}</td>

                </tbody>
            @endforeach
        </table>

    </div>
</div>
<div>
    <div class="sub-input-02">
        <button class="button-opcion-form cancel-option" onclick="cancelPage()"><i class="fi fi-sr-document-circle-wrong icon-option"></i>Cancelar</button>
        <button class="button-opcion-form clear-option" onclick="clearInput()"><i class="fi fi-sr-broom icon-option"></i>Limpiar</button>
        <button class="button-opcion-form element-option" onclick="addItems()"><i class="fi fi-sr-add-document icon-option"></i>Agregar un elemento</button>
        <button class="button-opcion-form register-option"><i class="fi fi-sr-registration-paper icon-option"></i>Registrar</button>
        <script src="{{ asset($FunctionButtonOnclick) }}"></script>

    </div>
</div>
<script src="{{ asset($OptionSelector) }}"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
