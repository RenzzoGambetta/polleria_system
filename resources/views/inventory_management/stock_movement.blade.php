<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($StockMovement) }}">
<div class="mobile-option">
<a href="#1"  title="Nueva Salida" class="a-arrow arrow-down"><i class='bx bxs-downvote bx-rotate-180'></i></a><a href="#2" title="Nueva Entrada" class="a-arrow arrow-up"><i class='bx bxs-downvote ' ></i></a>
</div>

<div class="header">
    <div class="left">
        <h1>Movimientos</h1>
        <ul class="breadcrumb">

            <a href="{{ route('inventory') }}" class="active">
                Movimientos
            </a>
            <li>
                /
            </li>
            <a class="pagina">
                {{ __('Lista de :from al :to de un total de :total   ', ['from' => $Movement->firstItem(), 'to' => $Movement->lastItem(), 'total' => $Movement->total()]) }}
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

            <div class="btn-optin desktop"><a href="{{ route('show_panel_register_output') }}"  title="Nueva Salida" class="a-arrow arrow-down"><i class='bx bxs-downvote bx-rotate-180'></i></a><a href="{{ route('show_panel_register_entry') }}" title="Nueva Entrada" class="a-arrow arrow-up"><i class='bx bxs-downvote ' ></i></a></div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Productos</th>
                    <th>Movimiento</th>
                    <th>Cantidad</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                @foreach ($Movement as $Movements)
                    <tr>
                        <td>{{ $Movements->supply->name }}</td>
                        <td></td>
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
    {{ $Movement->onEachSide(1)->links('pagination::custom') }}
    {{ $Movement->onEachSide(1)->links('pagination::numeros') }}
    {{ $Movement->onEachSide(1)->links('pagination::anterior') }}
</section>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
