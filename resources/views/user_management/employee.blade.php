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
@csrf

<div class="btn-mobile mobile">
    <a href="{{ route('employeer_register') }}?action=new"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
</div>

<div class="header">
    <div class="left">
        <h1>Empleados</h1>
        <ul class="breadcrumb">
            <a href="{{ route('user') }}" class="sub-link">
                Usuario
            </a>
            <li>
                /
            </li>
            <a href="{{ route('employeer') }}" class="active">
                todo
            </a>
            <li>
                /
            </li>
            <a class="pagina">
                {{ __('Lista de :from al :to de un total de :total   ', ['from' => $List->firstItem(), 'to' => $List->lastItem(), 'total' => $List->total()]) }}
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
            <a href="{{ route('employeer_register') }}?action=new" class="desktop"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Nacimiento</th>
                    <th>Usuario</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($List as $List_)
                    <tr>

                        <td>{{ $List_->person->document_number ?? ' ' }}</td>
                        <td>{{ $List_->person->name ?? ' ' }}</td>
                        <td>{{ $List_->person->lastname ?? ' ' }}</td>
                        <td>{{ $List_->person->phone ?? ' ' }}</td>
                        <td>{{ $List_->person->birthdate ?? ' ' }}</td>
                        <td>
                            @if ($List_->user)
                                 {{ $List_->user->username }}
                            @endif
                        </td>
                        <td class="option">
                            <button class="button-option-employee clear" title="Eliminar el empleado" onclick="urlPostDelete('{{route('employeer_delete')}}',{id : {{$List_->id}}}, '¿Estás seguro?', 'Este ítem será permanentemente eliminado.')">
                                <i class="fi fi-sr-trash option-table"></i>
                            </button>
                            <button class="button-option-employee edit" onclick="urlGet('{{route('employeer_register')}}',{id : {{$List_->id}}, action:'edit'})" title="Editar datos empleado">
                                <i class="fi fi-sr-user-pen option-table" ></i>
                            </button>
                            <button class="button-option-employee view" onclick="urlGet('{{route('data_employer_block')}}',{id : {{$List_->id}}})" title="Visualizar los datos del empleado">
                                <i class="fi fi-ss-eye option-table"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<section class="paginacion">
    {{ $List->onEachSide(1)->links('pagination::custom') }}
    {{ $List->onEachSide(1)->links('pagination::numeros') }}
    {{ $List->onEachSide(1)->links('pagination::anterior') }}
</section>

<script src="{{ asset($AlertSrc) }}"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
