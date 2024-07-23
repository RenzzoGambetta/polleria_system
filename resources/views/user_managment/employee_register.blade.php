<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($Form) }}">
<script src="{{ $JquerySrc }}" integrity="{{ $JqueryIntegrity }}" crossorigin="{{ $JqueryCrossorigin }}"></script>


<div class="header">
    <div class="left">
        <h1>Registro</h1>
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
                    <h2 class = "ms_txt">selecciona un dato dni o ruc</h2>
                </div>
            </section>
        </div>

    </section>

    <form method="post" action="#ola">
        @csrf
        <section class="form_pos">

            <section class="form_pos2">
                <h1 class="text-center">Formulario <i class='bx bxs-user-voice'></i></h1>
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
                            <input type="text" id="Nombre" name="nombre" class="effect-4" placeholder=" "
                                required
                                value="{{ session()->has('data') && session('data')['nombre'] !== null ? session('data')['nombre'] : '' }}" />
                            <label for="Nombre">Nombre</label>
                        </div>
                        <div class="input-group col-md-6" id="div_frame_dni_input">
                            <input type="number" id="frame_dni_input" name="documento_dni" class="effect-4"
                                placeholder=" "value="{{ session()->has('data') && session('data')['documento'] !== null ? session('data')['documento'] : '' }}">
                            <label for="fechaNacimiento">DNI</label>
                            <div id="busqueda">
                                <h1 id="lupa"><i class="bx bxs-file-find" id="iten"></i></h1>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-group col-md-6">
                            <input type="text" id="Paterno" name="paterno" class="effect-4" required
                                placeholder=" "
                                value="{{ session()->has('data') && session('data')['paternal_surname'] !== null ? session('data')['paternal_surname'] : '' }}" />
                            <label for="Paterno">Apellido Paterno</label>
                        </div>
                        <div class="input-group col-md-6">
                            <input type="text" id="Materno" name="materno" class="effect-4" required
                                placeholder=" "
                                value="{{ session()->has('data') && session('data')['apellido_materno'] !== null ? session('data')['apellido_materno'] : '' }}" />
                            <label for="Materno">Apellido Materno</label>
                        </div>
                    </div>
                    <div class="">
                        <a href="#" class="btn btn-next width-50 ml-auto">Siguiente</a>
                    </div>

                </div>
                <div class="form-step">

                    <div class="row">
                        <div class="select">
                            <div class="generos">
                                <label class="genero">
                                    <input type="radio" name="genero" id="Hombre" required value="hombre" />
                                    <span> Hombre </span>
                                </label>

                                <label class="genero">
                                    <input type="radio" id="Mujer" name="genero" required value="mujer" />
                                    <span> Mujer </span>
                                </label>
                            </div>
                            <div class="posgenero">Genero <i class='bx bxs-eject bx-rotate-180'></i></div>
                        </div>
                        <div class="input-group col-md-6">
                            <input type="Date" id="fechaNacimiento" name="fecha_n" class="effect-4"
                                placeholder=" " />
                            <label for="fechaNacimiento">Fecha de Nacimiento</label>
                        </div>
                    </div>
                    <div class="input-group col-md-6">
                        <input type="text" id="nacionalidad" class="effect-4" name="nacionalidad"
                            placeholder=" " />
                        <label for="nacionalidad">Nacionalidad</label>
                    </div>

                    <div class="btns-group">
                        <a href="#" class="btn btn-prev">Atras</a>
                        <a href="#" class="btn btn-next">Siguiente</a>
                    </div>
                </div>
                <div class="form-step">
                    <div class="row">
                        <div class="input-group col-md-6">
                            <input type="number" id="Telefono" class="effect-4" name="telefono"
                                placeholder=" " />
                            <label for="Telefono">Telefono</label>
                        </div>
                        <div class="input-group col-md-6 one">
                            <input type="email" id="Correo" name="correo" required class="effect-4"
                                placeholder=" " />
                            <label for="Correo">Correo</label>
                        </div>
                    </div>
                    <div class="input-group col-md-6 one">
                        <input type="text" id="Direccion" name="direccion"  class="effect-4"
                            placeholder=" " />
                        <label for="Direccion">Direccion</label>
                    </div>


                    <div class="btns-group">
                        <a href="#" class="btn btn-prev">Atras</a>
                        <input type="submit" value="Registrar" class="btn" id="submitButton"
                            onclick="validarFormulario(event)" />
                    </div>


                </div>
            </section>

        </section>
    </form>
</section>

<script src="{{ asset($EffectsAndActions) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
