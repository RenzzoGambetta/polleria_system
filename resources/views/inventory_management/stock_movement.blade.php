<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($StockMovement) }}">
<div class="mobile-option">
<a href="{{ route('show_panel_register_output') }}"  title="Nueva Salida" class="a-arrow arrow-down"><i class='bx bxs-downvote bx-rotate-180'></i></a><a href="{{ route('show_panel_register_entry') }}" title="Nueva Entrada" class="a-arrow arrow-up"><i class='bx bxs-downvote ' ></i></a>
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
                    <th>Provedor</th>
                    <th>Dia</th>
                    <th>Tipo</th>
                    <th>total_amount</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($Movement as $Movements)
                    <tr>
                        <td>{{ $Movements['proveedor'] }}</td>
                        <td>{{ $Movements['date'] }}</td>
                        <td>{{ $Movements['type'] }}</td>
                        <td>{{ $Movements['total_amount'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>


<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
