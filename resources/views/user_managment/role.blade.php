<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">

<div class="header">
    <div class="left">
        <h1>Roles de Trabajo</h1>
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
            <a  class="pagina">
                {{ __('Lista de :from al :to de un total de :total  roles ', ['from' => $Roles->firstItem(), 'to' => $Roles->lastItem(), 'total' => $Roles->total()]) }}
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
            <a href="{{ route('role_register') }}"><i class='bx bx-plus-medical '
                    style ="color:red; font-size: 18px; padding: 10px;border-radius: 30px; background-color:  #fcb755"
                    id="Mas"> Nuevo</i></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acceso</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($Roles as $rol)
                <tr>
                    <td>{{ $rol->id ?? 'No registrado' }}</td>
                    <td>{{ $rol->name ?? 'No registrado' }}</td>
                    <td>Sin data</td>
                    <td>Sin data</td>
                    <td>No asignado</td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>


<section class="paginacion">
    {{ $Roles->onEachSide(1)->links('pagination::custom') }}
    {{ $Roles->onEachSide(1)->links('pagination::numeros') }}
    {{ $Roles->onEachSide(1)->links('pagination::anterior') }}
</section>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
