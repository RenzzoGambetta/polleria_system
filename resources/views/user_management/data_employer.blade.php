<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($Form) }}">
<link rel="stylesheet" href="{{ asset($DataEmployerBlock) }}">

<div class="header">
    <div class="left">
        <h1>{{ $Info['title'] }}</h1>
        <ul class="breadcrumb">
            <a href="{{ route('user') }}" class="sub-link">
                Usuario
            </a>
            <li>
                /
            </li>
            <a href="{{ route('employeer') }}" class="sub-link">
                Empleado
            </a>
            <li>
                /
            </li>
            <a href="{{ route('data_employer_block') }}?{{ $Info['data'] ?? '' }}" class="active">
                {{ $Info['sub_title'] }}
            </a>

        </ul>
    </div>
</div>

<section>

    <div class="e-card playing">
        <div class="image"></div>

        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>

        <div class="infotop">
            <i class="fi fi-sr-user-shield user-icon-employer"></i>
            <br>
               <span class="name-employer"></span> {{$Info->person->name}}
            <br>
            <div class="name">MikeAndrewDesigner</div>
        </div>
    </div>
</section>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
