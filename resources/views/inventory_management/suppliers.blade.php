<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<div class="btn-mobile mobile">
    <a href="{{ route('suppliers_register_and_edit') }}"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
</div>

<div class="header">
    <div class="left">
        <h1>Provedores</h1>
        <ul class="breadcrumb">

            <a href="{{ route('inventory') }}" class="active">
                Inventario
            </a>
            <li>
                /
            </li>
            <a class="pagina">
                {{ __('Lista de :from al :to de un total de :total   ', ['from' => $Suppliers->firstItem(), 'to' => $Suppliers->lastItem(), 'total' => $Suppliers->total()]) }}
            </a>

        </ul>
    </div>
</div>

<input type="checkbox" id="theme-toggle" hidden>

<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Lista</h3>
            <a href="{{ route('suppliers_register_and_edit') }}" class="desktop"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Ruc o Dni</th>
                    <th>Nombre</th>
                    <th>Celular</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($Suppliers as $Suplier)
                    <tr>
                        <td>{{ $Suplier->person->document_number }}</td>
                        <td>{{ $Suplier->person->name }} {{ $Suplier->person->lastname }}</td>
                        <td>
                            @if ($Suplier->person  && $Suplier->person->phone )
                                {{ $Suplier->person->phone  }}
                            @else
                                <span></span>
                            @endif
                        </td>
                        <td>-------</td>
                        <td><button type="button" class="btn-clasic">Eitar</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<section class="paginacion">
    {{ $Suppliers->onEachSide(1)->links('pagination::custom') }}
    {{ $Suppliers->onEachSide(1)->links('pagination::numeros') }}
    {{ $Suppliers->onEachSide(1)->links('pagination::anterior') }}
</section>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
