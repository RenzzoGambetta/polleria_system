<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include('template.header')
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">

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
            <a href="#" class="pagina">

            </a>

        </ul>
    </div>
</div>

<form action=" " id="filtered" method="get" onchange="cambiarAccion()">
    <div class="form-input">
        <select name="ig_">
            <option value="t_o" selected>Todo</option>
            <option value="v_od">active</option>
            <option value="n_vod">Inactive</option>
        </select>
        <button class="search-btn" type="submit"><i class='bx bx-filter'></i></button>
    </div>
</form>

<input type="checkbox" id="theme-toggle" hidden>

<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Lista</h3>
            <a href="{{ route('employeer_register') }}"><i class='bx bx-plus-medical bx-flashing '
                    style ="color:red; font-size: 18px; padding: 10px;border-radius: 30px; background-color:  #fcb755" id="Mas"> Nuevo</i></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Edad</th>
                    <th>Nacionalidad</th>
                    <th>Verificación</th>
                </tr>
            </thead>

            <tbody>


            </tbody>
        </table>


    </div>
</div>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include('template.footer')
<!------------------------------------------------------------>
