<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include('{{ asset($HeaderPanel) }}')
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
                <div id="datos">
                    <div class="row-container">
                        <div class="sunat" id="parte_1">
                            <div class="dropdown">
                                <label for="uiux" class="optio">
                                    <input type="radio" name="dni" id="uiux" value="dni"/>
                                    <span> DNI </span>
                                </label>

                                <label for="frontend" class="optio">
                                    <input type="radio" id="frontend" name="ruc" value="ruc"/>
                                    <span> RUC </span>
                                </label>
                            </div>
                            <div class="select-box">Dato <i class='bx bxs-eject bx-rotate-180'></i></div>
                        </div>

                        <div class="input-group overflow-hidden" id="parte_2">
                            <input type="number" name="dato" class="effect-6" />
                            <span class="bg"></span>
                        </div>
                        <div id="busqueda">
                            <h1 id="lupa"><i class="bx bxs-file-find" id="iten"></i></h1>
                        </div>
                    </div>
                </div>
                @if(session()->has('Ms'))
                <div class = "ms_dt">
                    <h4 class = "ms_tp">Alert:</h4>
                    <h2 class = "ms_txt">{{session('Ms')}}</h2>
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

    <form method="post" action="#" >
            @csrf
            <section class="form_pos">

            <section class="form_pos2">
            <h1 class="text-center">Formulario <i class='bx bxs-user-voice'></i></h1>
            <!-- Progress bar -->
            <div class="progressbar">
              <div class="progress" id="progress"></div>

              <div
                class="progress-step progress-step-active"
                data-title="Identidad"
              ></div>
              <div class="progress-step" data-title="Datos"></div>
              <div class="progress-step" data-title="Contacto"></div>
              <div class="progress-step" data-title="Registro"></div>
              <div class="progress-step" data-title="info"></div>
            </div>


            <!-- Steps -->
            <div class="form-step form-step-active">
                <div class="row">
                  <div class="input-group col-md-6">
                    <input type="text" id="Nombre" name="nombre" class="effect-4" placeholder=" " required value="{{ (session()->has('data') && session('data')['nombre'] !== null) ? session('data')['nombre'] : '' }}"/>
                    <label for="Nombre">Nombre</label>
                  </div>
                  <div class="input-group col-md-6">
                    <input type="Date" id="fechaNacimiento" name="fecha_n" class="effect-4" placeholder=" " />
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-group col-md-6">
                    <input type="text" id="Paterno" name="paterno" class="effect-4" required placeholder=" " value="{{ (session()->has('data') && session('data')['apellido_paterno'] !== null) ? session('data')['apellido_paterno'] : '' }}"/>
                    <label for="Paterno">Apellido Paterno</label>
                  </div>
                  <div class="input-group col-md-6">
                    <input type="text" id="Materno" name="materno" class="effect-4" required placeholder=" " value="{{ (session()->has('data') && session('data')['apellido_materno'] !== null) ? session('data')['apellido_materno'] : '' }}"/>
                    <label for="Materno">Apellido Materno</label>
                  </div>
                </div>
              <div class="">
                <a href="#" class="btn btn-next width-50 ml-auto">Siguiente</a>
              </div>

            </div>
            <div class="form-step">
                <div class="row">
                    @if (session()->has('data') && isset(session('data')['documento']))
                    <div class="select">
                        <div class="options">
                          <label for="dni" class="option">
                            <input type="radio" name="data" id="dni" required value="DNi"/>
                            <span> DNI </span>
                          </label>

                          <label for="ruc" class="option">
                            <input type="radio" id="ruc" required name="data"/>
                            <span> RUC </span>
                          </label>
                        </div>
                        <div class="selected">Dni <i class='bx bxs-eject bx-rotate-180'></i></div>
                    </div>

                      <div class="input-group col-md-6" id="dniInput">
                        <input type="number" id="dni_op" name="documento_dni"  class="effect-4" placeholder=" " value="{{ session('data')['documento'] }}" />
                        <label for="dni_op">Ingresa el Dni</label>
                      </div>

                      <div class="input-group col-md-6" id="rucInput">
                        <input type="number" id="ruc_op" name="documento_ruc"  class="effect-4" placeholder=" " />
                        <label for="ruc_op">Ingresa el ruc</label>
                      </div>

                      <div class="input-group col-md-6" id="none">
                        <input type="text" id="Dato" class="effect-4" placeholder=" "  disabled/>
                        <label  style="color:rgb(255, 60, 60)"> <- Ponga el dato </label>
                      </div>
                      <script>
                        $(document).ready(function() {
                            $('#dniInput, #rucInput, #none').hide();
                            $('#dniInput').show();
                            $('input[name="data"]').change(function() {
                                if ($('#dni').is(':checked')) {
                                    $('#dniInput').show();
                                    $('#rucInput, #none').hide();
                                } else if ($('#ruc').is(':checked')) {
                                    $('#dniInput, #none').hide();
                                    $('#rucInput').show();
                                } else {
                                    $( '#rucInput,#none').hide();
                                    $(' #dniInput').show();
                                }
                            });
                        });
                      </script>

                    @else
                    <div class="select">
                        <div class="options">
                          <label for="dni" class="option">
                            <input type="radio" name="data" id="dni" required value="dni"/>
                            <span> DNI </span>
                          </label>

                          <label for="ruc" class="option">
                            <input type="radio" id="ruc" name="data" required value="ruc"/>
                            <span> RUC </span>
                          </label>
                        </div>
                        <div class="selected">Selecciona <i class='bx bxs-eject bx-rotate-180'></i></div>
                    </div>

                      <div class="input-group col-md-6" id="dniInput">
                        <input type="number" id="dni_op" name="documento_dni" class="effect-4" placeholder=" " />
                        <label for="dni_op">Ingresa el Dni</label>
                      </div>

                      <div class="input-group col-md-6" id="rucInput">
                        <input type="number" id="ruc_op" name="documento_ruc" class="effect-4" placeholder=" " />
                        <label for="ruc_op">Ingresa el ruc</label>
                      </div>

                      <div class="input-group col-md-6" id="none">
                        <input type="text" id="Dato" class="effect-4" placeholder=" "  disabled/>
                        <label  style="color:rgb(255, 60, 60)"> <- Ponga el dato </label>
                      </div>
                      <script>
                        $(document).ready(function() {
                            // Ocultar campos de entrada inicialmente
                            $('#dniInput, #rucInput, #none').hide();

                            // Mostrar la sección por defecto
                            $('#none').show();

                            // Mostrar/ocultar campos de entrada según la selección del botón de radio
                            $('input[name="data"]').change(function() {
                                if ($('#dni').is(':checked')) {
                                    $('#dniInput').show();
                                    $('#rucInput, #none').hide();
                                } else if ($('#ruc').is(':checked')) {
                                    $('#dniInput, #none').hide();
                                    $('#rucInput').show();
                                } else {
                                    $('#dniInput, #rucInput').hide();
                                    $('#none').show();
                                }
                            });
                        });
                      </script>

                    @endif


                </div>

                <div class="row">
                    <div class="select">
                        <div class="generos">
                        <label  class="genero">
                          <input type="radio" name="genero" id="Hombre" required value="hombre"/>
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
                      <input type="text" id="nacionalidad" class="effect-4" required name="nacionalidad" placeholder=" " />
                      <label for="nacionalidad">Nacionalidad</label>
                    </div>
                  </div>

                  <div class="btns-group">
                    <a href="#" class="btn btn-prev">Atras</a>
                    <a href="#" class="btn btn-next">Siguiente</a>
                  </div>
                </div>

            <div class="form-step">
                  <div class="row">
                    <div class="input-group col-md-6">
                      <input type="number" id="Telefono" class="effect-4" required name="telefono" placeholder=" "/>
                      <label for="Telefono">Telefono</label>
                    </div>

                    <div class="select">
                        <div class="cargos">
            <!-- for ech de cargo completar -->

                    </div>
                      <div class="poscargo">Cargo <i class='bx bxs-eject bx-rotate-180'></i></div>
                    </div>

                  </div>
                    <div class="input-group col-md-6 one">
                      <input type="text" id="Direccion" name="direccion" required class="effect-4" placeholder=" "/>
                      <label for="Direccion">Direccion</label>
                    </div>

              <div class="btns-group">
                <a href="#" class="btn btn-prev">Atras</a>
                <a href="#" class="btn btn-next">Siguiente</a>
              </div>
            </div>

            <div class="form-step">
                <div class="input-group col-md-6 one">
                    <input type="email" id="Correo" name="correo" required class="effect-4" placeholder=" "/>
                    <label for="Correo">Correo</label>
                </div>
                <div class="row">
                  <div class="input-group col-md-6">
                    <input type="password" id="Contraseña" name="contraseña" required class="effect-4" placeholder=" "/>
                    <label for="Contraseña">Contraseña</label>
                  </div>
                  <div class="input-group col-md-6">
                    <input type="password" id="C_Contraseña" name="conrasenia" required class="effect-4" placeholder=" "/>
                    <label for="C_Contraseña">Confirmar Contraseña</label>
                  </div>
                </div>
                <div>
                    <p id="mensaje-contraseña" class="password-match"></p>
                </div>

            <div class="btns-group">
              <a href="#" class="btn btn-prev">Atras</a>
              <a href="#" class="btn btn-next">Siguiente</a>
            </div>
          </div>
            <div class="form-step">
                <h3 id="termino">**Términos y Condiciones**


                </h3>


              <div class="btns-group">
                <a href="#" class="btn btn-prev">Atras</a>
                <input type="submit" value="Registrar" class="btn" id="submitButton" onclick="validarFormulario(event)" />
            </form>
              </div>

            </div>
        </section>
    </form>
    </section>
</section>

<script src="{{ asset($EffectsAndActions) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include('{{ asset($FooterPanel) }}')
<!------------------------------------------------------------>
