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
    <div class="div-primary-conteiner-01">
        <div class="new-item">
            <button class="a-navegation-and-action-data retain-data" type="button" onclick="sectionData()"><i class="fi fi-ss-floppy-disk-pen"></i></button>
        </div>
        <div class="conteiner-total">
            <div class="bottom-data">
                <div class="orders">
                    <table class="table-striped-columns table">
                        <thead>
                            <tr>
                                <th class="Order">Orden</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="sortable" >
                            @foreach ($Category as $Categories)
                                <tr data-id="{{ $Categories->id }}">
                                    <td class="order">{{ $Categories->display_order }}</td>
                                    <td>{{ $Categories->name }}</td>
                                    <td>2</td>
                                    <td>
                                        <button type="button" class="btn-clasic" >Editar</button>
                                        <button type="button" class="btn-clasic view-item" onclick="urlGet('{{ route('show_order_item') }}',{'category_id':{{ $Categories->id }}})">Ver Item</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="div-primary-conteiner-02">
        <div class="dub-block-002">
            <h1 class="sub-title">Nueva categoria</h1>
            <span class="limit-data"></span>
            <div class="frame001">
                <div class="col-3 input-effect data-series order-number">
                    <input type="text" name="display_order" id="order-number" class="effect-16" placeholder=" " value="{{ $Category->count() + 1 }}">
                    <label for="order-number">Orden</label>
                    <span class="focus-border"></span>
                </div>
                <div class="col-3 input-effect data-numeric order-name">
                    <input class="effect-16" type="text" name="name" id="name" placeholder="" value="">
                    <label for="name">Nombre</label>
                    <span class="focus-border"></span>
                </div>
            </div>
            <div class="frame002">
                <button type="button" class="btn-cancel-data" onclick="urlGet('{{ route('menu') }}')">Cancelar</button>
                <button type="button" class="btn-register-data" onclick="addRow()">Agregar</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ $DragAndDrop }}"></script>
<script src="{{ asset($OrderTable) }}"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
