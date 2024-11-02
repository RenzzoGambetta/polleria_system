<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<script src="{{ asset($FunctionGlobal) }}"></script>
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($RoleRegisterDesktop) }}">

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
                <input type="text" id="name" class="effect-1" name="name" placeholder="Nombre de Rol" value="{{ old('name') }}" />
                <span class="border"></span>
            </div>
            <input type="submit" class="button-opcion next" value="Registrar">
        </div>

    </div>
    <div class="input-group">

        <div class="title_categories_primary">Permisos</div>
        <div class="input-group">
            <div class="check container">
                @foreach ($Categories as $category => $permissionGroup)
                    <div class="apo" id="dimensions-{{ $category }}">
                        <div class="checkbox checkbox-1">
                            <input type="checkbox" id="category_{{ $category }}" class="category-checkbox" />
                            <label for="category_{{ $category }}" class="title_categories">{{ $category }}</label>
                        </div>
                        <div class="sub-rol" data-category-id="category_{{ $category }}">
                            @foreach ($permissionGroup as $permission)
                                <div class="checkbox checkbox-1">
                                    <input type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" class="permission-checkbox" />
                                    <label for="permission_{{ $permission->id }}" class="sub_categories">{{ $permission->name }}</label>
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
