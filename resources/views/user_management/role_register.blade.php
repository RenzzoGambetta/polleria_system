<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->

<script src="{{ asset($AlertSrc) }}"></script>
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($RoleRegisterDesktop) }}">

@if (session()->has('Message'))
    <div class="container-aler">
        <div class="alert-error-and-response {{ session('Type') ?? 'error' }}">
            <div class="message-title-and-timer">
                <span class="tilte-alert">Mensaje:</span>
                <span class="sub-title-time" id="timer">{{ session('Time') ?? 10 }}s</span>
            </div>
            <span class="text-alert">{{ session('Message') }}</span>
        </div>
    </div>
    <script>
        timeAlert({{ session('Time') ?? 10 }})
    </script>
@endif

<div class="header">
    <div class="left">
        <h1>{{ $Info['title'] }}</h1>
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

<form action="{{ route($Info['form_url'], isset($Info['id_user']) ? ['id_user' => $Info['id_user'], 'action' => 'edit'] : []) }}" method="POST">
    @csrf
    @if (isset($Info['id']))
        <input type="number" name="id" value="{{ $Info['id'] ?? 0 }}" style="display: none">
    @endif
    <div class="name-input container">

        <div id="dimensions name-input">
            <input type="button" class="button-opcion previous" onclick="cancelRole()" value="Cancelar">
            <div class="input-group name-input">
                <input type="text" id="name" class="effect-1" name="name" placeholder="{{ $Info['input_text'] ?? 'Nombre de Rol' }}" value="{{ old('name', $Info['name'] ?? '') }}" required />
                <span class="border"></span>
            </div>
            <input type="submit" class="button-opcion next" value="{{ $Info['button_text'] }}">
        </div>

    </div>
    <div class="input-group">

        <div class="title_categories_primary">Permisos</div>
        <div class="input-group">
            <div class="check container">

                @foreach ($Categories as $categoryName => $category)
                    <div class="apo" id="dimensions-{{ $categoryName }}">

                        <div class="checkbox checkbox-1">
                            <input type="checkbox" id="category_{{ $categoryName }}" class="category-checkbox" {{ isset($category->checked) && $category->checked ? 'checked' : '' }} />
                            <label for="category_{{ $categoryName }}" class="title_categories">
                                {{ $categoryName }}
                            </label>
                        </div>

                        <div class="sub-rol" data-category-id="category_{{ $categoryName }}">
                            @foreach ($category->permissions as $permission)
                                <div class="checkbox checkbox-1">
                                    <input type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" class="permission-checkbox" {{ isset($permission->checked) && $permission->checked ? 'checked' : '' }} />
                                    <label for="permission_{{ $permission->id }}" class="sub_categories">
                                        {{ $permission->name }}
                                    </label>
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
