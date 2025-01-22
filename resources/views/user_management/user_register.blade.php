<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($Form) }}">

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
        @endif
        <section class="form_pos">
            <section class="form_pos2">
                <h1 class="title-form-h1 text-center">Formulario <i class='bx bxs-user-voice'></i></h1>

                <div class="form-step form-step-active user-section">

                    <div class="row">
                        <div class="select">
                            <div class="employers">
                                <label class="employer">
                                    <input type="radio" id="E-0" name="employee_id" value="" {{ empty($Info->employee_id) ? 'checked' : '' }} />
                                    <span> Empleado </span>
                                </label>
                                @foreach ($Employee as $Employee_)
                                    <label class="employer">
                                        <input type="radio" id="E-{{ $Employee_->id ?? 'not_id' }}" name="employee_id" value="{{ $Employee_->id ?? 'not_id' }}" {{ $Employee_->id == ($Info->employee_id ?? 0) ? 'checked' : '' }} />
                                        <span> {{ $Employee_->person->name ?? 'No registrado' }} </span>
                                    </label>
                                @endforeach
                            </div>
                            <div class="posemployer">{{ $Info->employee->person->name ?? 'Empleado' }}<i class='bx bxs-eject bx-rotate-180'></i></div>
                        </div>

                        <div class="select one role-data">
                            <div class="roles role-data">
                                @foreach ($Role as $Role_)
                                    <label class="role">
                                        <input type="radio" id="R-{{ $Role_->id ?? 'not_id' }}" name="role_id" value="{{ $Role_->id ?? 'not_id' }}" {{ $Role_->id == ($Info->role_id ?? 0) ? 'checked' : '' }} />
                                        <span> {{ $Role_->name ?? 'No registrado' }} </span>
                                    </label>
                                @endforeach

                            </div>
                            <button type="button" onclick="modifyRoleUser('{{route('role_register')}}',{{$Info['id'] ?? null}})" class="button-option-edit-role">
                                <i class="fi fi-br-edit role-edit-icon"></i>
                            </button>
                            <div class="posrole">{{ $Info->role->name ?? 'Selecciona el rol' }}<i class='bx bxs-eject bx-rotate-180'></i></div>
                        </div>
                    </div>

                    <div class="input-group col-md-6 one unique">
                        <input type="text" id="user_name" class="effect-4" name="username" placeholder=" " value="{{ $Info->username ?? '' }}" required />
                        <label for="user_name">*Nombre de Usuario</label>

                    </div>
                    <div class="row">
                        <div class="input-group col-md-6">
                            <input type="password" id="password_primary" class="effect-4" name="password" placeholder=" " title="{{ $Info['text_info_password'] ?? 'introduzca la contraseña' }}" {{ $exit ?? 'required' }} />
                            <label for="password_primary">{{ $Info['text_password'] }}</label>
                        </div>
                        <div class="input-group col-md-6 one">
                            <input type="password" id="password_repeat" class="effect-4" name="password_confirmation" placeholder=" " title="{{ $Info['text_info_password'] ?? 'introduzca la contraseña' }}" {{ $exit ?? 'required' }} />
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
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
