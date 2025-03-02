<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($MenuTable) }}">
<link rel="stylesheet" href="{{ asset($CategoryMenu) }}">

<div class="header">
    <div class="left">
        <h1>Carta</h1>
        <ul class="breadcrumb">
            <a href="{{ route('menu') }}" class="sub-link">
                Menu
            </a>
            <li>
                /
            </li>
            <a href="{{ route('category_carte') }}" class="active">
                Previsualizacion de Carta
            </a>

        </ul>
    </div>
</div>
@csrf

<div class="conteiner-header-data">
    <div class="div-primary-conteiner-02" style="display: none">
        <div class="dub-block-002">
            <div class="sub-title-data">
                <h1 class="sub-title" id="sub-title-category">Nueva categoria</h1>
            </div>
            <div class="frame001">
                <div class="col-3 input-effect data-series order-number input-effect-001">
                    <input type="text" name="display_order" id="order-number" class="effect-16" placeholder=" ">
                    <label for="order-number">Orden</label>
                    <span class="focus-border"></span>
                </div>
                <div class="col-3 input-effect data-numeric order-name input-effect-001">
                    <input class="effect-16" type="text" name="name" id="name" placeholder=" " value="">
                    <label for="name">Nombre</label>
                    <span class="focus-border"></span>
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
                                    <th class="Order">Orden</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @foreach ($Category as $Categories)
                                    <tr data-id="{{ $Categories->id }}" title="Arrastra y suelta en la posicion deseada">
                                        <td id="order_number_{{ $Categories->id}}" class="order">{{ $Categories->display_order }}</td>
                                        <td id="name_category_{{ $Categories->id}}">{{ $Categories->name }}</td>
                                        <td id="quantity_items_{{ $Categories->id}}">{{ $Categories->items_count }}</td>
                                        <td class="center-btn-options">
                                            <button title="Ver los platos o bebidas asociasos" type="button" class="btn-clasic view-item" onclick="urlGet('{{ route('show_order_item') }}',{'category_id':{{ $Categories->id }}})"><i class="fi fi-rr-overview option-table"></i>Ver Item</button>
                                            <button title="Editar la categoria" type="button" class="btn-clasic edit-button" onclick="editCategoryCarte({{ $Categories->id }})"><i class="fi fi-sc-pencil option-table"></i></button>
                                            <button title="Eliminar la categoria" type="button" class="btn-clasic delete-button" onclick="deleteCategory({{ $Categories->id }})"><i class="fi fi-sr-trash option-table"></i></button>
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

<script src="{{ asset($DragAndDrop) }}"></script>
<script src="{{ asset($OrderTable) }}"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
