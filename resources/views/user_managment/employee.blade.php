<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">

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
            <a  class="pagina">
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
            <a href="{{ route('employeer_register') }}"><i class='bx bx-plus-medical '
                    style ="color:red; font-size: 18px; padding: 10px;border-radius: 30px; background-color:  #fcb755"
                    id="Mas"> Nuevo</i></a>
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
                </tr>
            </thead>
            @foreach ($List as $employee)
            <tr>
                <td>{{ $employee->person->dni }}</td>
                <td>{{ $employee->person->firstname ?? 'No registrado' }}</td>
                <td>{{ $employee->person->lastname ?? 'No registrado' }}</td>
                <td>{{ $employee->person->phone ?? 'No registrado' }}</td>
                <td>{{ $employee->person->birthdate ?? 'No registrado' }}</td>
                <td>No asignado</td>
            </tr>
            @endforeach
            <tbody>


            </tbody>
        </table>


    </div>
</div>
<section class="paginacion">
    {{ $List->onEachSide(1)->links('pagination::custom') }}
    {{ $List->onEachSide(1)->links('pagination::numeros') }}
    {{ $List->onEachSide(1)->links('pagination::anterior') }}
</section>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
