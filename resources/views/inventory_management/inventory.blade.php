<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">

@if (session()->has('Message'))
    <div class="container-aler">
        <div class="alert-error-and-response {{ session('Type') ?? 'error'}}">
            <div class="message-title-and-timer">
                <span class="tilte-alert">Mensaje:</span>
                <span class="sub-title-time" id="timer">{{ session('Time') ?? 10}}s</span>
            </div>
            <span class="text-alert">{{ session('Message')}}</span>
        </div>
    </div>
    <script>
        timeAlert({{ session('Time') ?? 10}})
    </script>
@endif

<div class="btn-mobile mobile">
    <a href="{{ route('new_supply_inventory') }}"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
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
            <a href="{{ route('new_supply_inventory') }}" class="desktop"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Stock</th>
                    <th>Marca</th>
                    <th>Codigo</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($Inventory as $Inventories)
                    <tr>
                        <td>{{ $Inventories->name }}</td>
                        <td>{{ $Inventories->stock }}</td>
                        <td>
                            @if ($Inventories->brand && $Inventories->brand->name)
                                {{ $Inventories->brand->name }}
                            @else
                                <span></span>
                            @endif
                        </td>
                        <td>
                            @if ($Inventories->code )
                                #{{ $Inventories->code }}
                            @else
                                <span></span>
                            @endif
                        </td>
                        <td><a class="btn-clasic" href="{{ route('new_supply_inventory').'?id='.$Inventories->id}}">Eitar</a></td>
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
