<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<div class="btn-mobile mobile">
    <a href="{{ route('show_panel_register_entry') }}"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
</div>

<div class="header">
    <div class="left">
        <h1>Inventario</h1>
        <ul class="breadcrumb">

            <a href="{{ route('inventory') }}" class="active">
                todos
            </a>
            <li>
                /
            </li>
            <a class="pagina">
                {{ __('Lista de :from al :to de un total de :total   ', ['from' => $Inventory->firstItem(), 'to' => $Inventory->lastItem(), 'total' => $Inventory->total()]) }}
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
            <a href="{{ route('show_panel_register_entry') }}" class="desktop"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
        </div>
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

            <tbody>

                @foreach ($Inventory as $Inventories)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>-------</td>
                        <td>-------</td>
                        <td>-------</td>
                        <td>-------</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<section class="paginacion">
    {{ $Inventory->onEachSide(1)->links('pagination::custom') }}
    {{ $Inventory->onEachSide(1)->links('pagination::numeros') }}
    {{ $Inventory->onEachSide(1)->links('pagination::anterior') }}
</section>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
