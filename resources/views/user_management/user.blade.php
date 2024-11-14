<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">

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
                    <th>Nombre Usuario</th>
                    <th>Rol</th>
                    <th>Empleado</th>
                    <th>Acceso</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($Users as $user)
                    <tr>
                        <td>{{ $user->username ?? 'No registrado' }}</td>
                        <td>{{ $user->role->name ?? 'No registrado' }}</td>
                        <td>{{ $user->employee->person->name ?? 'No registrado' }}</td>
                        <td>-------</td>
                        <td>-------</td>
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
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
