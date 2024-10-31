<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($RoleRegisterDesktop) }}">

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
<form action="{{ route('role_register_store') }}" method="POST">
    @csrf
    <div class="name-input container">

        <div id="dimensions name-input">
            <input type="submit" class="button-opcion previous" value="Cancelar">
            <div class="input-group name-input">
                <input type="text" id="name" class="effect-1" name="name" placeholder="Nombre de Rol" value="" />
                <span class="border"></span>
            </div>
            <input type="submit" class="button-opcion next" value="Registrar">
        </div>

    </div>

    <div class="input-group">

        <div class="title_categories_primary">Permisos</div>
        <div class="input-group">
            <div class="check container">
                @foreach ($Categories as $categories => $permissionGroup)
                    <div id="dimensions" class="apo">
                        <div class="checkbox checkbox-1">
                            <input type="checkbox" id="{{ $categories }}" />
                            <label for="{{ $categories }}" class="title_categories">{{ $categories }}</label>
                        </div>
                        <div id="{{ $categories }}" class="sub-rol">
                            @foreach ($permissionGroup as $permission)
                                <div class="checkbox checkbox-1">
                                    <input type="checkbox" id="C_{{ $permission->name }}" name="permissions[]" value="{{ $permission->id }}" />
                                    <label for="C_{{ $permission->name }}" class="sub_categories">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</form>

<script src="{{ asset($RoleRegistrationButtonActions) }}"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
