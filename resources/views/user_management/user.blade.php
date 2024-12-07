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
    <a href="{{ route('user_register') }}"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
</div>

<div class="header">
    <div class="left">
        <h1>Usuarios</h1>
        <ul class="breadcrumb">

            <a href="{{ route('employeer') }}" class="active">
                todos
            </a>
            <li>
                /
            </li>
            <a class="pagina">
                {{ __('Lista de :from al :to de un total de :total   ', ['from' => $Users->firstItem(), 'to' => $Users->lastItem(), 'total' => $Users->total()]) }}
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
            <a href="{{ route('user_register') }}" class="desktop"><i class='fi fi-sr-multiple style-button-plus' id="Mas"> Nuevo</i></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Empleado</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($Users as $user)
                    <tr>
                        <td>{{ $user->username ?? 'No registrado' }}</td>
                        <td>{{ $user->role->name ?? 'No registrado' }}</td>
                        <td>{{ $user->employee->person->name ?? 'No registrado' }}</td>
                        <td class="option">
                            <button class="button-option-employee clear" title="Eliminar el usuario" onclick="urlPostDelete('{{route('user_delete')}}',{id : {{$user->id}}}, '¿Estás seguro?', 'Este ítem será permanentemente eliminado.')">
                                <i class="fi fi-sr-trash option-table"></i>
                            </button>
                            <button class="button-option-employee edit" onclick="urlGet('{{route('user_register')}}',{id : {{$user->id}}, action:'edit'})" title="Editar datos de usuario">
                                <i class="fi fi-sr-user-pen option-table" ></i>
                            </button>
                            <button class="button-option-employee view" onclick="urlGet('{{route('data_employer_block')}}',{id : {{$user->id}}})" title="Visualizar los datos del usuario">
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
    {{ $Users->onEachSide(1)->links('pagination::custom') }}
    {{ $Users->onEachSide(1)->links('pagination::numeros') }}
    {{ $Users->onEachSide(1)->links('pagination::anterior') }}
</section>

<script src="{{ asset($AlertSrc) }}"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
