<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<script src="{{ $AlertSrc }}"></script>
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($TableEditAndRegister) }}">
<link rel="stylesheet" href="{{ asset($openingClosingDesignStyle) }}">

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
        <h1>{{ $Data['Title'] }}@if (Auth::check())
                {{ Auth::user()->username }}!
            @endif
        </h1>
        <ul class="breadcrumb">
            <a href="{{ route('point_of_sale') }}" class="sub-link">
                Caja
            </a>
            <li>
                /
            </li>
            <a href="{{ route('category_carte') }}" class="active">
                {{ $Data['SubTitle'] }}
            </a>

        </ul>
    </div>
</div>

@php
    $comment = 'Comentario';
@endphp

<form action="{{ route('register_session_cash_box') }}" method="POST" class="cash-register-body">
    @csrf
    <div class="cash-register-body">
        @if ($Data['Option'])
            <div class="notification-box">
                <p><span class="user-name">{{ $specs->name }}</span> abrió la caja anteriormente.</p>
                <p class="box-details">
                    APERTURA: {{ $specs->cash_open_at }}1 | S/ {{ $specs->opening_balance }}
                </p>
            </div>
            <div class="cash-register-main-container clouse">
                <div class="cash-register-status-left">
                    <div class="cash-register-lock-icon"><i class="fi fi-sr-unlock color-icon"></i></div>
                    <div class="cash-register-status-info">
                        <span class="cash-register-status-badge">ABIERTO</span>
                        <p class="cash-register-status-time">
                            Abierto el día <span class="cash-register-highlight cash-register-date">{{ $format['date'] }}</span><br>
                            a las <span class="cash-register-highlight cash-register-time">{{ $format['time'] }}</span>
                        </p>
                    </div>
                </div>
                <div class="cash-register-closing-section">
                    <input value="{{ Auth::user()->id }}" name="user_id" style="display: none">
                    <button class="cash-register-close-button">Cerrar caja</button>
                </div>
            </div>
        <div class="div-note clouse">
        @else
            <div class="cash-register-main-container">
                <div class="cash-register-status-left">
                    <div class="cash-register-lock-icon"><i class="fi fi fi-sr-lock color-icon-lock"></i></div>
                    <div class="cash-register-status-info">
                        <span class="cash-register-status-badge lock">Cerrado</span>
                        <p class="cash-register-status-time">
                            La caja actualmente esta cerrado <span class="cash-register-highlight cash-register-date">,Se abrira hoy?</span>
                        </p>
                    </div>
                </div>
                <div class="cash-register-closing-section">
                    <div class="cash-register-amount-group">
                        <input value="1" name="employee_id" style="display: none">
                        <label class="cash-register-amount-label">EMPLEADO ENCARGADO</label>
                        <div class="cash-register-amount-container">
                            <input type="text" class="cash-register-amount-input" placeholder="Jose" name="employe" value="{{ old('employe') }}">
                        </div>
                        <p class="cash-register-amount-note">(*) Valida que el empleado este registrado.</p>
                    </div>
                    <div class="cash-register-amount-group">
                        <label class="cash-register-amount-label">INGRESE MONTO DE APERTURA</label>
                        <div class="cash-register-amount-container">
                            <span class="cash-register-currency-symbol">S/</span>
                            <input type="text" class="cash-register-amount-input" placeholder="0.00" name="opening_balance" value="{{ old('opening_balance') }}" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46">
                        </div>
                        <p class="cash-register-amount-note">(*) Considerar solo dinero en efectivo.</p>
                    </div>

                    <button class="cash-register-close-button lock">Abrir Caja</button>
                </div>
            </div>
        <div class="div-note">
        @endif
            <div class="wave-group input-dimensions comment">
                <textarea class="input effect-4 comment" rows="5" cols="50" maxlength="500" name="note" id="comment-input" placeholder=" ">{{ old('note') }}</textarea>
                <label class="label">
                    @foreach (str_split($comment) as $index => $char)
                        <span style="--index: {{ $index }}" class="label-char">{{ $char }}</span>
                    @endforeach
                </label>
            </div>
        </div>
    </div>

</form>

<script src="{{ asset($openingClosingDesignFunction) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
