<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">

<div class="header">
    <div class="left">
        <h1>Registro de nuevo Rol</h1>
        <ul class="breadcrumb">

            <a href="{{ route('position') }}" class="sub-link">
                roles
            </a>
            <li>
                /
            </li>
            <a href="#" class="pagina" class="active">
                nuevo
            </a>

        </ul>
    </div>
</div>
<link rel="stylesheet" href="{{ asset($RoleRegisterDesktop) }}">


<div class="input-group">
    <div class="container">
        <div id="op_op">
            <div class="input-group">
                <input type="text" name="Nombre" id="Nombre" class="effect-1" placeholder="Nombre de cargo"
                    value="" />
                <span class="border"></span>
            </div>
        </div>
    </div>
    <div style="width: 100%; text-align: center; font-size: 20px; color: #ff6363;">Permisos</div>
    <div class="input-group">
        <div class="container">

            <div id="op_op" class="apo">
                <div class="checkbox checkbox-1">
                    <input type="checkbox" id="Clientes" />
                    <label for="Clientes">Clientes</label>
                </div>
                <div id="subOrden_Clientes">
                    <div class="checkbox checkbox-1">
                        <input type="checkbox" id="C_Editar" />
                        <label for="C_Editar">Editar</label>
                    </div>
                    <div class="checkbox checkbox-1">
                        <input type="checkbox" id="C_Buscar" />
                        <label for="C_Buscar">Buscar</label>
                    </div>
                    <div class="checkbox checkbox-1">
                        <input type="checkbox" id="C_Descargar" />
                        <label for="C_Descargar">Descargar</label>
                    </div>
                </div>


            </div>


        </div>
    </div>
</div>




<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
