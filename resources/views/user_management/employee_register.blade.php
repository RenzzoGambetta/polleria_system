<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($Form) }}">

<div class="header">
    <div class="left">
        <h1>{{$Info['title']}}</h1>
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
            <a href="{{ route('employeer_register')}}?{{$Info['data'] ?? ''}}" class="active">
                {{$Info['title']}}
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
            <input type="number" name="id" value="{{$Info['id'] ?? 0}}" style="display: none">
        @endif
        <section class="form_pos">

            <section class="form_pos2">
                <h1 class="text-center title-form-h1">Formulario <i class='bx bxs-user-voice'></i></h1>
                <!-- Progress bar -->
                <div class="progressbar">
                    <div class="progress" id="progress"></div>

                    <div class="progress-step progress-step-active" data-title="Identidad"></div>
                    <div class="progress-step" data-title="Datos"></div>
                    <div class="progress-step" data-title="Contacto"></div>
                </div>


                <!-- Steps -->
                <div class="form-step form-step-active">
                    <div class="row">
                        <div class="input-group col-md-6">
                            <input type="text" id="name_input" class="effect-4" name="name" placeholder=" " required value="{{ old('name', $Info->person->name ?? '') }}" />
                            <label for="Nombre">*Nombre</label>
                        </div>
                        <div class="input-group col-md-6" id="div_frame_dni_input">
                            <input type="number" id="frame_dni_input" class="effect-4" name="dni" placeholder=" " required value="{{ old('dni', $Info->person->document_number ?? '') }}">
                            <label for="Dni">*DNI</label>
                            <div id="busqueda">
                                <h1 id="lupa"><i class="bx bxs-file-find" id="iten"></i></h1>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-group col-md-6">
                            <input type="text" id="paternal_surname_input" class="effect-4" name="paternal_surname" placeholder=" " required value="{{ old('paternal_surname', $Info->lastname->paternal_surname ?? '') }}" />
                            <label for="Paterno">*Apellido Paterno</label>
                        </div>
                        <div class="input-group col-md-6">
                            <input type="text" id="maternal_surname_input" class="effect-4" name="maternal_surname" placeholder=" " required value="{{ old('maternal_surname', $Info->lastname->maternal_surname ?? '') }}" />
                            <label for="Materno">*Apellido Materno</label>
                        </div>
                    </div>
                    <div class="btn-navegation-form">
                        <a class="btn btn-next width-50 ml-auto">Siguiente</a>
                    </div>

                </div>
                <div class="form-step">

                    <div class="row">
                        <div class="select">
                            <div class="generos">
                                <label class="genero">
                                    <input type="radio" id="Hombre" name="gender" value="0" {{ isset($Info->person->gender) && $Info->person->gender == 1 ? 'checked' : '' }}/>
                                    <span> Hombre </span>
                                </label>

                                <label class="genero">
                                    <input type="radio" id="Mujer" name="gender" value="1" {{ isset($Info->person->gender) && $Info->person->gender == 1 ? 'checked' : '' }} />
                                    <span> Mujer </span>
                                </label>
                            </div>
                            <div class="posgenero">
                                {{ isset($Info->person->gender) && $Info->person->gender == 0 ? 'Hombre' : (isset($Info->person->gender) && $Info->person->gender == 1 ? 'Mujer' : 'Genero') }}
                                <i class='bx bxs-eject bx-rotate-180'></i></div>
                        </div>
                        <div class="input-group col-md-6 one">
                            <input type="Date" id="fechaNacimiento" class="effect-4" name="birthdate" placeholder=" " required value="{{ old('birthdate', $Info->person->birthdate ?? '' )}}"/>
                            <label for="fechaNacimiento">*Fecha de Nacimiento</label>
                        </div>
                    </div>
                    <div class="input-group col-md-6 one unique">
                        <input type="text" id="nacionalidad" class="effect-4" name="nationality" placeholder=" " required value="{{ old('nationality', $Info->nationality ?? '' ) }}"/>
                        <label for="nacionalidad">*Nacionalidad</label>
                    </div>

                    <div class="btns-group btn-navegation-form-3frem">
                        <a  class="btn btn-prev">Atras</a>
                        <a  class="btn btn-next">Siguiente</a>
                    </div>
                </div>
                <div class="form-step">
                    <div class="row">
                        <div class="input-group col-md-6">
                            <input type="number" id="Telefono" class="effect-4" name="phone" placeholder=" " required value="{{ old('phone', $Info->person->phone ?? '' ) }}"/>
                            <label for="Telefono">*Telefono</label>
                        </div>
                        <div class="input-group col-md-6 one">
                            <input type="email" id="Correo" class="effect-4" name="email" placeholder=" " required value="{{ old('email', $Info->person->email ?? '' ) }}"/>
                            <label for="Correo">*Correo</label>
                        </div>
                    </div>
                    <div class="input-group col-md-6 one unique">
                        <input type="text" id="Direccion" class="effect-4" name="address" placeholder=" " required value="{{ old('address', $Info->address ?? '' ) }}"/>
                        <label for="Direccion">*Direccion</label>
                    </div>


                    <div class="btns-group btn-navegation-form-3frem">
                        <a  class="btn btn-prev">Atras</a>
                        <input type="submit" class="btn" id="submitButton" value="{{$Info['title']}}" onclick="validarFormulario(event)" />
                    </div>


                </div>
            </section>

        </section>
    </form>
</section>
<script src="{{ asset($EffectsAndActions) }}"></script>
<script src="{{ asset($FueryFetch) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
