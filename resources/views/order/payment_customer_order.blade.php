<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<script src="{{ asset($AlertSrc) }}"></script>
<link rel="stylesheet" href="{{ asset($InventoryRegisterDesktop) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($TableEditAndRegister) }}">
<link rel="stylesheet" href="{{ asset($loaderOrder) }}">
<link rel="stylesheet" href="{{ asset($ItemSelectionAlert) }}">
<link rel="stylesheet" href="{{ asset($SearchBox) }}">
<link rel="stylesheet" href="{{ asset($pointModify) }}">
<link rel="stylesheet" href="{{ asset($ItemOrder) }}">
<link rel="stylesheet" href="{{ asset($newOrder) }}">
<link rel="stylesheet" href="{{ asset($openingClosingDesignStyle) }}">
<link rel="stylesheet" href="{{ asset($paymentCustomer) }}">

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

@csrf
<div class="header-item">DETALLE PEDIDO</div>
<div class="container-item-data">
    <div class="left-panel">
        <div class="frame-table-item">
            <table class="order-table">
                <thead>
                    <tr>
                        <th class="star-item-border">Cant.</th>
                        <th>Producto</th>
                        <th class="end-item-border">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Item as $item)
                        <tr class="tr-data-item-order" id="id-{{ $item['id'] }}">
                            <td class="frame-nemeric-item">{{ $item['quantity'] }}</td>
                            <td class="product-name">{{ $item['name'] }}<span class="tag" style="background-color: {{ $item['is_delibery'] === 1 ? '#720000b3' : '#0030c2b3' }}">{{ $item['is_delibery'] === 1 ? 'Delivery' : 'Mesa' }}</span></td>
                            <td>{{ $item['total_price'] }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="totals">
            <div class="total-row">
                <span>Sub Total</span>
                <span>S/ 28.50</span>
            </div>
            <div class="total-row">
                <span>Cortesía / Descuento</span>
                <span>S/ 0.00</span>
            </div>
            <div class="total-row">
                <span>Comisión delivery</span>
                <span>S/ 0.00</span>
            </div>
            <div class="total-row final-total">
                <span>TOTAL</span>
                <span>S/ 28.50</span>
            </div>
        </div>
    </div>

    <div class="right-panel">
        <div class="document-type">
            TIPO DE DOCUMENTO
            <div class="doc-buttons">
                <button class="doc-button active">BOLETA</button>
                <button class="doc-button">FACTURA</button>
                <button class="doc-button">NOTA DE VENTA</button>
            </div>
        </div>

        <div class="data-client">
            <h1 class="sub-title-client">Datos de cliente</h1>
            <div class="sub-frame-01">
                <button class="new-client-data"><i class="fi fi-ss-user-add center-icon"></i></button>
                <div class="search-container">
                    <input type="number" id="id-waiter-client" name="id_person" style="display: none">
                    <input type="text" id="search-client" name="document_and_name_to_person" class="search-box-data-client input-iten effect-5 no-spinner alert-style" placeholder=" " autocomplete="off">
                    <label for="search-client" id="search-label-client" class="label-input-data mobile-label">Busca cliente</label>

                    <div id="suggestions" class="suggestions-client">

                    </div>
                </div>
                <button class="clear-client-data"><i class="fi fi-sr-broom center-icon"></i></button>
            </div>

        </div>

        <div class="payment-section">
            FORMAS DE PAGO
            <div class="payment-type">EFECTIVO</div>
        </div>
        <div class="amount-input">
            <div class="mount-calc-data">
                <div class="motorcycle-received-customer">
                    <div class="cash-register-amount-group">
                        <label class="cash-register-amount-label">INGRESE MONTO</label>
                        <div class="cash-register-amount-container">
                            <span class="cash-register-currency-symbol">S/</span>
                            <input type="text" class="cash-register-amount-input" placeholder="0.00" name="opening_balance" value="{{ old('opening_balance') }}" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46">
                        </div>
                    </div>
                </div>
                <div class="total-amount-service">
                    <span class="sub-title-count-service">MONTO TOTAL</span>
                    <span class="sub-price-count-service">S/ 28.50</span>
                </div>
                <div class="total-amount-change">
                    <span class="sub-title-count-service">VUELTO</span>
                    <span style="color: green;" class="sub-price-count-service">S/ 0.00</span>
                </div>
            </div>
        </div>

        <div>
            <h1 class="sub-title-client">Pago Efectivo Rapido</h1>

            <div class="quick-amounts">
                <button type="button" class="amount-button selected"><i class="fi fi-sr-hand-holding-usd  center-icon"></i> s/ 21118.50</button>
                <button type="button" class="amount-button"><i class="fi fi-sr-coins center-icon"></i> s/ 10</button>
                <button type="button" class="amount-button"><i class="fi fi-sr-coins center-icon"></i> s/ 20</button>
                <button type="button" class="amount-button"><i class="fi fi-sr-coins center-icon"></i> s/ 50</button>
                <button type="button" class="amount-button"><i class="fi fi-sr-coins center-icon"></i> s/ 100</button>
                <button type="button" class="amount-button"><i class="fi fi-sr-coins center-icon"></i> s/ 200</button>
            </div>
        </div>
    </div>
</div>

<div class="action-buttons">
    <button class="action-button back">Volver</button>
    <button class="action-button accept">ACEPTAR</button>
</div>
<script src="{{ asset($SearchBoxTemplate) }}"></script>
<script src="{{ asset($searchBoxDataCliene) }}"></script>
<script>
    new SearchBoxClient('No se encuntro el Cliente...', '.search-box-data-client', '#search-client', '#search-label-client', '.suggestions-client', '#id-waiter-client', '/client_data_filt', 5, 0);
</script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
