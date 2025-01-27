<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
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
@csrf

<div class="btn-mobile mobile">
    <a href="{{ route('suppliers_register_and_edit') }}"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
</div>

<div class="header">
    <div class="left">
        <h1>Proveedores</h1>
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
                               
                            @endif
                        </td>
                        <td><span class="status-supplier">Activo</span></td>
                        <td class="option">
                            <button class="button-option-employee clear" title="Eliminar el empleado" onclick="urlPostDelete('{{route('delete_supplier')}}',{id : {{$Suplier->id}}}, '¿Estás seguro?', 'Este ítem será permanentemente eliminado.')">
                                <i class="fi fi-sr-trash option-table"></i>
                            </button>
                            <button class="button-option-employee edit" onclick="urlGet('{{route('suppliers_register_and_edit')}}',{id : {{$Suplier->id}}, action:'edit'})" title="Editar datos empleado">
                                <i class="fi fi-sr-user-pen option-table" ></i>
                            </button>
                            <button class="button-option-employee view" onclick="urlGet('{{route('data_employer_block')}}',{id : {{$Suplier->id}}})" title="Visualizar los datos del empleado">
                                <i class="fi fi-ss-eye option-table"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<style>
    span.status-supplier {
    padding: 6px 20px;
    background: #107c00;
    border-radius: 10px;
    font-size: 0.8rem;
    color: white;
    font-weight: 600;
}
</style>
<section class="paginacion">
    {{ $Suppliers->onEachSide(1)->links('pagination::custom') }}
    {{ $Suppliers->onEachSide(1)->links('pagination::numeros') }}
    {{ $Suppliers->onEachSide(1)->links('pagination::anterior') }}
</section>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
