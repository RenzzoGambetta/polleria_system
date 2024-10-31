<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<script src="{{ $AlertSrc }}"></script>
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($TableEditAndRegister) }}">
<link rel="stylesheet" href="{{ asset($openingClosingDesignStyle) }}">

<div class="header">
    <div class="left">
        <h1>{{ $Data['Title'] }}</h1>
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
@csrf
<div class="cash-register-body">
    @if ($Data['Option'])
    <div class="notification-box">
        <p><span class="user-name">Usuario demo</span> abrió la caja anteriormente.</p>
        <p class="box-details">
            <strong>CAJA 01 | PRIMER TURNO</strong><br>
            APERTURA: 03/10/24 09:41 | S/ 200.00
        </p>
    </div>
    <div class="cash-register-main-container">
        <div class="cash-register-status-left">
            <div class="cash-register-lock-icon"><i class="fi fi-sr-unlock color-icon"></i></div>
            <div class="cash-register-status-info">
                <span class="cash-register-status-badge">ABIERTO</span>
                <p class="cash-register-status-time">
                    Abierto el día <span class="cash-register-highlight cash-register-date">jueves, 3 de octubre</span><br>
                    a las <span class="cash-register-highlight cash-register-time">9:41:32 am</span>
                </p>
            </div>
        </div>
        <div class="cash-register-closing-section">
            <div class="cash-register-amount-group">
                <label class="cash-register-amount-label">INGRESE MONTO DE CIERRE</label>
                <div class="cash-register-amount-container">
                    <span class="cash-register-currency-symbol">S/</span>
                    <input type="text"
                           class="cash-register-amount-input"
                           placeholder="0.00"
                           onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46">
                </div>
                <p class="cash-register-amount-note">(*) Considerar solo dinero en efectivo.</p>
            </div>
            <button class="cash-register-close-button">Cerrar caja</button>
        </div>
    </div>
    @else
    <div class="cash-register-main-container">
        <div class="cash-register-status-left">
            <div class="cash-register-lock-icon"><i class="fi fi fi-sr-lock color-icon-lock"></i></div>
            <div class="cash-register-status-info">
                <span class="cash-register-status-badge lock">Serrado</span>
                <p class="cash-register-status-time">
                    La caja actualmente esta serrado <span class="cash-register-highlight cash-register-date">Se abrira hoy?</span>
                </p>
            </div>
        </div>
        <div class="cash-register-closing-section">
            <div class="cash-register-amount-group">
                <label class="cash-register-amount-label">EMPLEADO ENCARGADO</label>
                <div class="cash-register-amount-container">
                    <input type="text"
                           class="cash-register-amount-input"
                           placeholder="Jose">
                </div>
                <p class="cash-register-amount-note">(*) Valida que el empleado este registrado.</p>
            </div>
            <div class="cash-register-amount-group">
                <label class="cash-register-amount-label">INGRESE MONTO DE APERTURA</label>
                <div class="cash-register-amount-container">
                    <span class="cash-register-currency-symbol">S/</span>
                    <input type="text"
                           class="cash-register-amount-input"
                           placeholder="0.00"
                           onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46">
                </div>
                <p class="cash-register-amount-note">(*) Considerar solo dinero en efectivo.</p>
            </div>

            <button class="cash-register-close-button lock">Abrir Caja</button>
        </div>
    </div>
    @endif

</div>
<script src="{{ asset($FunctionGlobal) }}"></script>
<script src="{{ asset($openingClosingDesignFunction) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
