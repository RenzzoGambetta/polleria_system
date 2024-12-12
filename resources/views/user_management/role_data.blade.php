<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->

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
        <h1>{{ $Info['title'] }} {{ $Info['name']->name }}</h1>
        <ul class="breadcrumb">

            <a href="{{ route('position') }}" class="sub-link">
                roles
            </a>
            <li>
                /
            </li>
            <a href="{{route('data_role')}}?id={{$Info['id']}}"  class="active">
                {{ $Info['name']->name }}
            </a>

        </ul>
    </div>
</div>

@csrf
<div class="input-group">

    <div class="title_categories_primary">Permisos</div>
    <div class="input-group">
        <div class="check container">

            @foreach ($Categories as $categoryName => $category)
                @if ($category->checked)
                    <div class="apo-data" id="dimensions-{{ $categoryName }}">
                        <div class="checkbox-data checkbox-1">
                            <label class="title_categories">
                                {{ $categoryName }}
                            </label>
                        </div>
                        <div class="sub-rol" data-category-id="category_{{ $categoryName }}">
                            @foreach ($category->permissions as $permission)
                                @if ($permission->checked)
                                    <div class="checkbox-data checkbox-1">
                                        <label class="sub_categories">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
</div>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
