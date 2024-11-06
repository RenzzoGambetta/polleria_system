<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($Form) }}">
<link rel="stylesheet" href="{{ asset($SuppierEditAndRegister) }}">

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
        <h1>{{ $Data['option'] ?? '' }}</h1>
        <ul class="breadcrumb">
            <a href="{{ route('inventory') }}" class="sub-link">
                Inventario
            </a>
            <li>
                /
            </li>
            <a href="{{ route('suppliers') }}" class="sub-link">
                Provedores
            </a>
            <li>
                /
            </li>
            <a href="{{ route('employeer_register') }}" class="active">
                Editor o registro
            </a>

        </ul>
    </div>
</div>

<form method="post" class="form-container" ction="{{ route('create_employee_record') }}">
    @csrf

    <!-- Steps -->
    <div class="container-data-supplier">
        <div class="row">
            <div class="input-group col-md-6">
                <input type="text" id="name_input" class="effect-4" name="name" placeholder=" " required maxlength="50" value="{{ old('name', $Supply->name ?? '') }}"/>
                <label for="name_input">*Seudonimo o Razon social</label>
            </div>
            <div class="input-group col-md-6 one" id="div_frame_ruc_input">
                <input type="text" id="frame_ruc_input" class="effect-4" name="ruc" placeholder=" " required maxlength="11" value="{{ old('ruc', $Supply->ruc ?? '') }}"/>
                <label for="frame_ruc_input">*RUC</label>
            </div>
        </div>

        <div class="row">
            <div class="select">
                <div class="generos">
                    <label class="genero">
                        <input type="radio" id="Hombre" name="gender" value="male" />
                        <span> Hombre </span>
                    </label>

                    <label class="genero">
                        <input type="radio" id="Mujer" name="gender" value="feminine" />
                        <span> Mujer </span>
                    </label>
                </div>
                <div class="posgenero">Genero <i class='bx bxs-eject bx-rotate-180'></i></div>
            </div>

            <div class="input-group col-md-6 one">
                <input type="date" id="fechaNacimiento" class="effect-4" name="birthdate" placeholder=" " required value="{{ old('birthdate', $Supply->birthdate ?? '') }}"/>
                <label for="fechaNacimiento">*Fecha de Nacimiento</label>
            </div>
        </div>

        <div class="input-group col-md-6 one unique">
            <input type="text" id="nacionalidad" class="effect-4" name="nationality" placeholder=" " required maxlength="255" value="{{ old('nationality', $Supply->nationality ?? '') }}"/>
            <label for="nacionalidad">*Nacionalidad</label>
        </div>

        <div class="row">
            <div class="input-group col-md-6">
                <input type="text" id="Telefono" class="effect-4" name="phone" placeholder=" " required maxlength="20" value="{{ old('phone', $Supply->phone ?? '') }}"/>
                <label for="Telefono">*Teléfono</label>
            </div>
            <div class="input-group col-md-6 one">
                <input type="email" id="Correo" class="effect-4" name="email" placeholder=" " required value="{{ old('email', $Supply->email ?? '') }}"/>
                <label for="Correo">*Correo</label>
            </div>
        </div>

        <div class="input-group col-md-6 one unique">
            <input type="text" id="Direccion" class="effect-4" name="address" placeholder=" " required maxlength="255" value="{{ old('address', $Supply->address ?? '') }}"/>
            <label for="Direccion">*Dirección</label>
        </div>

        <div class="btns-group btn-navegation-form-3frem">
            <a href="#" class="btn">Atrás</a>
            <input type="submit" class="btn" id="submitButton" value="Registrar" />
        </div>
    </div>
</form>

</section>
<script>
    const posgenero = document.querySelector('.posgenero');
    const generos = document.querySelector('.generos');
    const genero = document.querySelectorAll('.genero');

    posgenero.addEventListener('click', () => {
        generos.classList.toggle('active');
    });

    genero.forEach(option => {
        option.addEventListener('click', () => {
            posgenero.innerHTML = option.querySelector('span').innerText;
            generos.classList.remove("active");
        });
    });

    document.addEventListener('click', (event) => {
        const isClickInside = posgenero.contains(event.target) || generos.contains(event.target);
        if (!isClickInside) {
            generos.classList.remove('active');
        }
    });
</script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
