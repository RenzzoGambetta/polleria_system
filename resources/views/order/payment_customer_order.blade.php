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
<link rel="stylesheet" href="{{ asset($radioButtonOptionStyle) }}">
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
<div id="alert-container" class="container-aler" style="display: none;">
    <div class="alert-error-and-response error">
        <div class="message-title-and-timer">
            <span class="tilte-alert">Mensaje:</span>
            <span class="sub-title-time" id="timer">10s</span>
        </div>
        <span class="text-alert" id="alert-message">Este es un mensaje de prueba.</span>
    </div>
</div>

<script>
    let items = @json($Item);
</script>
<input type="hidden" name="id_table" value="{{ $Data->id }}">
@csrf
<div class="header-item">Resumen de pedido de {{ $Data->lounge->name }} mesa: {{ $Data->code }}</div>
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
                            <td>s/ <span>{{ $item['total_price'] }}</span></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="totals">
            <div class="total-row">
                <span>Sub Total</span>
                <span>S/ <span>{{ $Data['sub_total'] }}</span></span>
            </div>
            <div class="total-row">
                <span>Cortesía / Descuento (no integrado)</span>
                <span>S/ 0.00</span>
            </div>
            <div class="total-row">
                <span>Adicionales / Extras (no integrado)</span>
                <span>S/ 0.00</span>
            </div>
            <div class="total-row final-total">
                <span>TOTAL</span>
                <span>S/ <span>{{ $Data['sub_total'] }}</span></span>
            </div>
        </div>
    </div>

    <div class="right-panel">
        <div class="document-type">
            <h1 class="sub-title-client">Tipo de Documento</h1>

            <div class="doc-buttons">
                <div class="frame-option-t-type-payment">
                    <label class="particles-checkbox-container">
                        <input type="radio" class="particles-checkbox" name="toggle" id="document-type" value="boleta" checked>
                        <span class="star-item-border"><i class="fi fi-ss-point-of-sale-bill center-icon"></i>Boleta</span>
                    </label>

                    <label class="particles-checkbox-container">
                        <input type="radio" class="particles-checkbox" name="toggle" id="document-type" value="factura">
                        <span><i class="fi fi-sr-calculator-bill center-icon"></i>Factura</span>
                    </label>

                    <label class="particles-checkbox-container">
                        <input type="radio" class="particles-checkbox" name="toggle" id="document-type" value="nota">
                        <span class="end-item-border"><i class="fi fi-sr-receipt center-icon"></i>Nota de Venta</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="data-client">
            <h1 class="sub-title-client">Datos de cliente</h1>
            <div class="sub-frame-01">
                <button class="new-client-data" onclick="newRegisterClientData()"><i class="fi fi-ss-user-add center-icon"></i></button>
                <div class="search-container">
                    <input type="number" id="id-waiter-client" name="id_person" style="display: none">
                    <input type="text" id="search-client" name="document_and_name_to_person" class="search-box-data-client input-iten effect-5 no-spinner alert-style" placeholder=" " autocomplete="off">
                    <label for="search-client" id="search-label-client" class="label-input-data mobile-label">Busca cliente</label>

                    <div id="suggestions" class="suggestions-client">
                        <div class="no-suggestions">Escrive Dni / Ruc o Nombre del Cliente...</div>
                    </div>
                </div>
                <button class="clear-client-data" onclick="clearOptionDataClient()"><i class="fi fi-sr-broom center-icon"></i></button>
            </div>

        </div>

        <div class="payment-section" id="button-option-type-payment">
            <h1 class="sub-title-client">Forma de Pago</h1>
            <div class="doc-buttons">
                <div class="multi-button">
                    <input type="hidden" name="input-type-payment" value="efectivo">
                    <input type="hidden" name="input-sub-type-payment" value="">
                    <input type="hidden" name="input-type-payment-group" value="1">
                    <button class="button-type-payment active" onclick="selectOptionTypePayment('efectivo',1)" id="efectivo"> <span>Efectivo</span> <i class="fi fi-rs-coins center-icon"></i> </button>
                    <button class="button-type-payment" onclick="selectOptionTypePayment('yape',2)" id="yape"> <span>Yape</span> <i class="fi fi-ss-comment-dollar center-icon"></i> </button>
                    <button class="button-type-payment" onclick="selectOptionTypePayment('plin',2)" id="plin"> <span>Plin</span> <i class="fi fi-ss-comment-dollar center-icon"></i> </button>
                    <button class="button-type-payment" onclick="selectOptionTypePayment('t-debito',2)" id="t-debito"> <span>T.Debito</span> <i class="fi fi-sr-credit-card center-icon"></i> </button>
                    <button class="button-type-payment" onclick="selectOptionTypePayment('t-credito',2)" id="t-credito"> <span>T.Credito</span> <i class="fi fi-sr-credit-card center-icon"></i> </button>
                </div>
                <button class="multi-option-pyment" title="Combinar con otro metodo de pago" onclick="combinePaymentType()" id="combine-type-payment-button"><i class="fi fi-bs-arrows-repeat center-icon"></i></button>
            </div>
        </div>
        <div class="amount-input" id="frame-efectivo-type">
            <div class="mount-calc-data">
                <div class="motorcycle-received-customer">
                    <div class="cash-register-amount-group">
                        <label class="cash-register-amount-label" id="sub-title-efectivo-mount">INGRESE MONTO</label>
                        <div class="cash-register-amount-container">
                            <span class="cash-register-currency-symbol">S/</span>
                            <input type="text" class="cash-register-amount-input" placeholder="{{ $Data['sub_total'] }}" name="input-total-payment" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46">
                        </div>
                    </div>
                </div>
                <div class="motorcycle-received-customer" id="type-data-form-sub-payment" style="display: none">
                    <div class="cash-register-amount-group">
                        <label class="cash-register-amount-label">Monto de <span id="sub-title-type-payment-option">yape</span></label>
                        <div class="cash-register-amount-container">
                            <span class="cash-register-currency-symbol">S/</span>
                            <input type="text" class="cash-register-amount-input input-option-2" placeholder="0" name="input-payment-option-2" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46">
                        </div>
                    </div>
                </div>
                <div class="total-amount-service">
                    <span class="sub-title-count-service">MONTO TOTAL</span>
                    <span class="sub-price-count-service">S/ <span id="primary-total-payment">{{ $Data['sub_total'] }}</span></span>
                </div>
                <div class="total-amount-change">
                    <span class="sub-title-count-service">VUELTO</span>
                    <span style="color: green;" class="sub-price-count-service">S/ <span id="return-money-client">0.00</span></span>
                </div>
            </div>
        </div>
        <div class="loader-option-combine" style="display: none" id="loader-option-combine-payment">
            <div class="card-option-payment">
                <div class="loader-option-payment">
                    <p>Puedes combinar con </p>
                    <div class="words-option-payment">
                        <span class="word-option-payment">Yape</span>
                        <span class="word-option-payment">Plin</span>
                        <span class="word-option-payment">T.Debito</span>
                        <span class="word-option-payment">T.Credito</span>
                        <span class="word-option-payment">Yape</span>
                    </div>
                </div>
            </div>
        </div>

        <div id="frame-efectivo-fast">
            <h1 class="sub-title-client">Pago Efectivo Rapido</h1>

            <div class="quick-amounts">
                <button type="button" class="amount-button selected" data-amount="{{ $Data['sub_total'] }}"><i class="fi fi-sr-hand-holding-usd center-icon"></i> s/ <span>{{ $Data['sub_total'] }}</span></button>
                <button type="button" class="amount-button" data-amount="10"><i class="fi fi-sr-coins center-icon"></i> s/ 10</button>
                <button type="button" class="amount-button" data-amount="20"><i class="fi fi-sr-coins center-icon"></i> s/ 20</button>
                <button type="button" class="amount-button" data-amount="50"><i class="fi fi-sr-coins center-icon"></i> s/ 50</button>
                <button type="button" class="amount-button" data-amount="100"><i class="fi fi-sr-coins center-icon"></i> s/ 100</button>
                <button type="button" class="amount-button" data-amount="200"><i class="fi fi-sr-coins center-icon"></i> s/ 200</button>
            </div>
        </div>
    </div>
</div>

<div class="action-buttons">
    <button class="action-button back" id="remember-account" style="display: none" onclick="refrehtPdf()">Volver a ver</button>
    <button class="action-button accept" id="pay-bill" onclick="payBill()">Pagar Cuenta</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<script src="{{ asset($AlertSrc) }}"></script>
<script src="{{ asset($SearchBoxTemplate) }}"></script>
<script src="{{ asset($searchBoxDataCliene) }}"></script>
<script src="{{ asset($paymentCostomerFunctioAndCalc) }}"></script>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>

