<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include( $HeaderPanel )
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">

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
            <a href="#" class="pagina">

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
                    style ="color:red; font-size: 18px; padding: 10px;border-radius: 30px; background-color:  #fcb755" id="Mas"> Nuevo</i></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>User name</th>
                    <th>Acceso</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>


            </tbody>
        </table>


    </div>
</div>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
