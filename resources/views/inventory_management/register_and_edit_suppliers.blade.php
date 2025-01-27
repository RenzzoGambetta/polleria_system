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
                Proveedores
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

<form method="POST" class="form-container" action="{{ route($Data['urlAccet']) }}">
    @csrf
    @if ($Data->id ?? false)
        <input type="hidden" name="id" value="{{ old('name', $Data->id ?? '') }}">
    @endif
    <!-- Steps -->
    <div class="container-data-supplier">
        <div class="row">
            <div class="input-group col-md-6">
                <input type="text" id="name_input" class="effect-4" name="name" placeholder=" " required maxlength="50" value="{{ old('name', $Data->person->name ?? '') }}"/>
                <label for="name_input">*Seudonimo o Razon social</label>
            </div>
            <div class="input-group col-md-6 one" id="div_frame_ruc_input">
                <input type="text" id="frame_ruc_input" class="effect-4" name="document_number" placeholder=" " required maxlength="11" value="{{ old('ruc', $Data->person->document_number ?? '') }}"/>
                <label for="frame_ruc_input">*RUC</label>
            </div>
        </div>
        <div class="input-group col-md-6 one">
            <input type="email" id="Correo" class="effect-4" name="email" placeholder=" " value="{{ old('email', $Data->person->email ?? '') }}"/>
            <label for="Correo">*Correo</label>
        </div>
        <div class="row">
            <div class="input-group col-md-6">
                <input type="text" id="Telefono" class="effect-4" name="phone" placeholder=" " maxlength="20" value="{{ old('phone', $Data->person->phone ?? '') }}"/>
                <label for="Telefono">*Teléfono</label>
            </div>
            <div class="input-group col-md-6 one">
                <input type="date" id="fechaNacimiento" class="effect-4" name="birthdate" placeholder=" " value="{{ old('birthdate', $Data->person->birthdate ?? '') }}"/>
                <label for="fechaNacimiento">*Fecha de fundacion</label>
            </div>
        </div>

        <div class="input-group col-md-6 one unique">
            <input type="text" id="Direccion" class="effect-4" name="address" placeholder=" " maxlength="255" value="{{ old('address', $Data->address ?? '') }}"/>
            <label for="Direccion">*Dirección</label>
        </div>

        <div class="btns-group btn-navegation-form-3frem">
            <a href="{{ route('suppliers')}}" class="btn">Atrás</a>
            <input type="submit" class="btn" id="submitButton" value="{{ $Data['subButthon'] ?? '' }}" />
        </div>
    </div>
</form>

</section>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
