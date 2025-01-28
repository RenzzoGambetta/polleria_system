<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($Form) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($ItemSelectionAlert) }}">
<link rel="stylesheet" href="{{ asset($SearchBox) }}">
<link rel="stylesheet" href="{{ asset($UserRegisterStyle) }}">

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
        <h1>{{ $Info['title'] }}</h1>
        <ul class="breadcrumb">
            <a href="{{ route('user') }}" class="sub-link">
                Usuario
            </a>
            <li>
                /
            </li>
            <a href="{{ route('employeer_register') }}" class="active">
                Registro
            </a>

        </ul>
    </div>
</div>

<section>
    <section class="form_pos1">
        <div id="Sentral">
            <section id="miFormulario">
                @if (session()->has('Ms'))
                    <div class = "ms_dt">
                        <h4 class = "ms_tp">Alert:</h4>
                        <h2 class = "ms_txt">{{ session('Ms') }}</h2>
                    </div>
                @endif

                <div class = "ms_rr active hide-element">
                    <h4 class = "ms_tp">Alert:</h4>
                    <h2 class = "ms_txt">Completa los campos vacios</h2>
                </div>
                <div class = "ms_bx active hide-element">
                    <h4 class = "ms_tp">Alert:</h4>
                    <h2 class = "ms_txt"> ms_txt </h2>
                </div>
            </section>
        </div>
    </section>

    <form method="post" action="{{ route($Info['form_url']) }}">
        @csrf
        @if (isset($Info['id']))
            <input type="number" name="id" value="{{ $Info['id'] ?? 0 }}" style="display: none">
            @php
                $exit = '';
            @endphp
            <script>employeeURL = '/list_of_employer?id={{$Info->id}}'</script>
        @else   
            <script>employeeURL = '/list_of_employer'</script>
        @endif
        <section class="form_pos">
            <section class="form_pos2">
                <h1 class="title-form-h1 text-center">Formulario <i class='bx bxs-user-voice'></i></h1>

                <div class="form-step form-step-active user-section">
                    <div class="row">
                        <div class="select">
                            <div class="search-container">
                                <input type="number" id="id-employer" name="employee_id" value="{{ $Info->employee->person->id ?? '' }}">
                                <input type="text" id="search-employer" name="employer_name" style="display: none" class="search-box-employer input-iten effect-5 no-spinner alert-style" placeholder=" " value="{{ $Info['person_name'] ?? '' }}" autocomplete="off">
                                <label for="search-employer" id="search-label-employer" class="label-input-data mobile-label main-panel">Seleccione el Empelado</label>
                                <div id="suggestions" class="suggestions-employer"></div>
                                <div id="loader-employer" class="loader-section">
                                    <div class="loading">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="select one role-data">
                            <div class="search-container">
                                <input type="number" id="id-role" name="role_id" value="{{ $Info->role->id ?? '' }}">
                                <input type="text" id="search-role" name="role_name" style="display: none" class="search-box-role input-iten effect-5 no-spinner alert-style" placeholder=" " value="{{ $Info->role->name ?? '' }}" autocomplete="off">
                                <label for="search-role" id="search-label-role" class="label-input-data mobile-label main-panel">Seleccione el Empelado</label>
                                <div id="suggestions" class="suggestions-role"></div>
                                <div id="loader-role" class="loader-section">
                                    <div class="loading">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <button type="button" onclick="modifyRoleUser('{{route('role_register')}}',{{$Info['id'] ?? null}})" class="button-option-edit-role">
                                <i class="fi fi-br-edit role-edit-icon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="input-group col-md-6 one unique">
                        <input type="text" id="user_name" class="effect-4" name="username" placeholder=" " value="{{ $Info->username ?? '' }}" required autocomplete="off"/>
                        <label for="user_name">*Nombre de Usuario</label>

                    </div>
                    <div class="row">
                        <div class="input-group col-md-6">
                            <input type="password" id="password_primary" class="effect-4" name="password" placeholder=" " title="{{ $Info['text_info_password'] ?? 'introduzca la contraseña' }}" {{ $exit ?? 'required' }} autocomplete="off"/>
                            <label for="password_primary">{{ $Info['text_password'] }}</label>
                        </div>
                        <div class="input-group col-md-6 one">
                            <input type="password" id="password_repeat" class="effect-4" name="password_confirmation" placeholder=" " title="{{ $Info['text_info_password'] ?? 'introduzca la contraseña' }}" {{ $exit ?? 'required' }} autocomplete="off"/>
                            <label for="password_repeat">{{ $Info['text_repeat_password'] }}</label>
                        </div>
                    </div>

                    <input type="submit" class="btn button-register" id="submitButton" value="Registrar" onclick="validarFormulario(event)" />

                </div>

            </section>
        </section>
    </form>
</section>
<script src="{{ asset($EffectsAndActionsUserRegister) }}"></script>
<script src="{{ asset($SearchBoxTemplate) }}"></script>

<script>
new SearchBox('No se encuntro el empleado...', '.search-box-supplier', '#search-employer', '#search-label-employer', '.suggestions-employer', '#loader-employer', '#id-employer', employeeURL, 5, 0);
new SearchBox('No se encuntro el rol...', '.search-box-role', '#search-role', '#search-label-role', '.suggestions-role', '#loader-role', '#id-role', '/list_of_role', 5, 0);
</script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
