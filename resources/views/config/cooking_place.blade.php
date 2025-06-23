<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($MenuTable) }}">
<link rel="stylesheet" href="{{ asset($CategoryMenu) }}">
<link rel="stylesheet" href="{{ asset($CookingPlaceStyle) }}">
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
        <h1>Lugar de preparacion</h1>
        <ul class="breadcrumb">
            <a href="{{ route('menu') }}" class="sub-link">
                Configuracion
            </a>
            <li>
                /
            </li>
            <a href="{{ route('category_carte') }}" class="active">
                Comandas
            </a>

        </ul>
    </div>
</div>
@csrf

<div class="conteiner-header-data">
    <div class="div-primary-conteiner-02" style="display: none">
        <div class="dub-block-002">
            <div class="sub-title-data">
                <h1 class="sub-title" id="sub-title-category">Nueva comanda</h1>
            </div>
            <div class="frame001">
                <div class="col-3 input-effect data-numeric order-name input-effect-001">
                    <input class="effect-16" type="text" name="name" id="name" placeholder=" " value="">
                    <label for="name">Nombre</label>
                    <span class="focus-border"></span>
                </div>
                <div class="col-3 input-effect data-series order-ip input-effect-001 ip">
                    <input type="text" name="display_order" id="ip" class="effect-16" placeholder="192.168.0.1" maxlength="15" oninput="formatearIP(this)">
                    <label class="ip-config" for="ip">Direccion Ip</label>
                    <span class="focus-border"></span>
                </div>
                <div class="col-3 input-effect data-series order-port input-effect-001 port">
                    <input type="text" name="display_order" id="port" class="effect-16" placeholder="9100" maxlength="5" value="9100" oninput="formatearPuerto(this)">
                    <label class="ip-config" for="port">Puerto</label>
                    <span class="focus-border"></span>
                </div>
                <div class="state-data-div">
                    <p class="sub-state">Estado</p>
                    <label class="switch-state">
                        <input type="checkbox">
                        <span class="slider-state"></span>
                        <span class="text-state on">Activo</span>
                        <span class="text-state off">Inactivo</span>
                    </label>
                </div>
            </div>
            <div class="frame002">
                <button type="button" class="btn-cancel-data" id="clear_to_input">Limpiar</button>
                <button type="button" class="btn-cancel-data" id="cancel_edit" style="display: none" onclick="cancelToEdit()">Cancelar</button>
                <button type="button" class="btn-register-data" id="add_to_table" onclick="addRow()">Agregar</button>
                <button type="button" class="btn-register-data btn-edit-data" id="edit_to_category" onclick="acceptEdition()" style="display: none">Editar</button>
            </div>
        </div>
    </div>
    <div class="div-primary-conteiner-01">
        <div class="new-item">
            <button class="a-navegation-and-action-data retain-data" type="button" title="Agregar nueva vategoria" onclick="showNewCategoriForm()"><i class="fi fi-sr-apps-add center"></i></button>
        </div>
        <div class="conteiner-total">
            <div class="bottom-data">
                <div class="orders">
                    <div class="container-data-table">
                        <table class="table-striped-columns table">
                            <thead>
                                <tr>
                                    <th class="name">Nombre</th>
                                    <th>Direccion Ip</th>
                                    <th>Puerto</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="sortable">

                                @foreach ($Command as $data)
                                    <tr data-id="{{ $data->id }}">
                                        <td class="name">{{ $data->name }}</td>
                                        <td>
                                            <div class="div-ip-and-port"><i class="fi fi-ss-ethernet center-to-icon-table"></i>{{ $data->ip }}</div>
                                        </td>
                                        <td>
                                            <div class="div-ip-and-port"><i class="fi fi-ss-system-cloud center-to-icon-table"></i>{{ $data->port }}</div>
                                        </td>
                                        <td>
                                            <p class="state-data {{ $data->state == 1 ? 'active-data' : 'inactive-data' }}">{{ $data->state == 1 ? 'Activo' : 'Inactivo' }}</p>
                                        </td>
                                        <td class="center-btn-options">
                                            <button title="Ver los platos o bebidas asociasos" type="button" class="btn-clasic view-item" onclick="urlGet('{{ route('show_order_item') }}',{'category_id':{{ $data->id }}})"><i class="fi fi-ss-print-magnifying-glass option-table"></i>Test</button>
                                            <button title="Editar la categoria" type="button" class="btn-clasic edit-button" onclick="editCategoryCarte({{ $data->id }})"><i class="fi fi-sc-pencil option-table"></i></button>
                                            <button title="Eliminar la categoria" type="button" class="btn-clasic delete-button" onclick="deleteCategory({{ $data->id }})"><i class="fi fi-sr-trash option-table"></i></button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <script>
                                var urlOrderItem = '{{ route('show_order_item') }}';
                            </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset($CookingPlaceEfect) }}"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
