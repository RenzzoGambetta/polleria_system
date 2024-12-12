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
            @if ($Info['type'] != 'user')
                <li>
                    /
                </li>
                <a href="{{ route('employeer') }}" class="sub-link">
                    Empleado
                </a>
            @endif
            <li>
                /
            </li>
            <a href="{{ route($Info['url']) }}?id={{ $Info->id ?? '' }}" class="active">
                {{ $Info['sub_title'] }}
            </a>

        </ul>
    </div>
</div>
@csrf

<section>

    <div class="e-card playing">
        <div class="image"></div>

        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>

        <div class="infotop">
            <i class="fi fi-sr-user-shield user-icon-employer"></i>
            <br>
            @if ($Info['type'] == 'employer')
                <div class="title-name-table-data">
                    <span class="name-employer"></span>{{ $Info['title'] }}: {{ $Info->person->name }}
                </div>
                <br>
                <div class="primary-front-row">
                    @if ($Info->person->name != null)
                        <div class="data-employer name"><samp class="sub-title-data-general">Nombre:</samp> {{ $Info->person->name ?? '' }} {{ $Info->person->lastname ?? '' }}</div>
                    @endif
                    @if ($Info->person->document_number != null)
                        <div class="data-employer document"><samp class="sub-title-data-general">Documento:</samp> {{ $Info->person->document_number }}</div>
                    @endif
                    @if ($Info->person->gender != null)
                        <div class="data-employer gender"><samp class="sub-title-data-general">Genero:</samp> {{ $Info->person->gender == 0 ? 'Hombre' : 'Mujer' }}</div>
                    @endif
                    @if ($Info->person->phone != null)
                        <div class="data-employer phone"><samp class="sub-title-data-general">Celular:</samp> {{ $Info->person->phone }}</div>
                    @endif
                    @if ($Info->nationality != null)
                        <div class="data-employer nationality"><samp class="sub-title-data-general">Nacionalidad:</samp> {{ $Info->nationality }}</div>
                    @endif
                    @if ($Info->person->birthdate != null)
                        <div class="data-employer birthdate"><samp class="sub-title-data-general">Fecha de Nacimiento:</samp> {{ $Info->person->birthdate }}</div>
                    @endif
                    @if ($Info->person->email != null)
                        <div class="data-employer email"><samp class="sub-title-data-general">Correo:</samp> {{ $Info->person->email }}</div>
                    @endif
                    @if ($Info->address != null)
                        <div class="data-employer address"><samp class="sub-title-data-general">Direccion:</samp> {{ $Info->address }}</div>
                    @endif

                </div>
            @endif
            @if ($Info['type'] == 'user')
                <div class="title-name-table-data">
                    <span class="name-employer"></span>{{ $Info['title'] }}: {{ $Info->username }}
                </div>
                <br>
                <div class="primary-front-row">
                    @if ($Info->role->name != null)
                        <div class="data-employer"><samp class="sub-title-data-general">Rol:</samp> {{ $Info->role->name ?? '' }} {{ $Info->person->lastname ?? '' }}</div>
                    @endif

                    @if ($Info->employee->person->name != null)
                        <div class="data-employer name-employer">
                            <div class="sub-data-employer">
                                <samp class="sub-title-data-general">Nombre Empleado:</samp> {{ $Info->employee->person->name ?? '' }} {{ $Info->employee->person->lastname ?? '' }}
                            </div>
                            <a class="button-redirect" href="{{ route('data_employer_block') }}?id={{ $Info->employee->id ?? '' }}"><i class="fi fi-sr-refer-arrow"></i></a>
                        </div>
                    @endif

                    @if ($Info->remember_token != null)
                        <div class="data-employer remember-token">
                            <div class="sub-data-remember-token">
                                <samp class="sub-title-data-general">Token:</samp><span id='data-token'>{{ $Info->remember_token ? str_repeat('*', strlen($Info->remember_token)) : '' }}</span>
                            </div>
                            <button class="button-redirect" onclick="queryTokenDatabase({{ $Info->id }})"><i class="fi fi-ss-eye"></i></button>
                        </div>
                    @endif

                    @if ($Info->commentary != null)
                        <div class="data-employer commentary"> <samp class="sub-title-data-general">Comentario:</samp> {{ $Info->commentary ?? '' }}</div>
                    @endif

                    @if ($Info->created_at != null)
                        <div class="data-employer commentary"> <samp class="sub-title-data-general">Fecha registrad@:</samp> {{ $Info->created_at ?? '' }}</div>
                    @endif

                    @if ($Info->updated_at != null)
                        <div class="data-employer commentary"> <samp class="sub-title-data-general">Fecha editad@:</samp> {{ $Info->updated_at ?? '' }}</div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>
<script>
    async function queryTokenDatabase(id) {
        var data = await consultDataPost('data_toket_query', {
            id: id
        });

        // Mostrar el token por 10 segundos
        $('#data-token').text(data.token);

        // Crear una cadena de asteriscos con la misma longitud que el token
        var hiddenToken = '*'.repeat(data.token.length);

        // Después de 10 segundos, cambiar el contenido a la cadena de asteriscos
        setTimeout(() => {
            $('#data-token').text(hiddenToken);
        }, 10000);
    }
</script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
