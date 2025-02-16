<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($ItemSelectionAlert) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($SearchBox) }}">
<link rel="stylesheet" href="{{ asset($StyleMovementDetail) }}">
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

<div class="header">
    <div class="left">
        <h1>{{ $Data['title'] }}</h1>
        <ul class="breadcrumb">

            <a href="{{ route('inventory') }}" class="pagina">
                Inventario
            </a>
            <li>
                /
            </li>
            <a href="{{ route('show_list_inventory_movements') }}" class="pagina">
                Movimientos
            </a>
            /
            </li>
            <a href="{{ route('show_list_inventory_movements') }}" class="active">
                {{ $Data['title'] }}
            </a>
        </ul>
    </div>
</div>

<input type="checkbox" id="theme-toggle" hidden>
@if ($Data['title'] == 'Entrada')
    <div class="data-supplier-and-vaucher">
        <div class="facture-number">
            <span>Nº de {{ $DataMovement?->voucher?->voucherSerie?->voucherType?->name ?? 'N/A' }}: </span><span class="spam-title">{{ $DataMovement?->voucher?->voucherSerie?->serie_number ?? 'N/A-000' }}-{{ $DataMovement?->voucher?->correlative_number ?? 'N/A' }}</span>
        </div>
        <div class="supplier-name">
            <p>Proveedor: <a href="{{ route('data_supplier_block', ['id' => $DataMovement?->supplier?->id ?? null]) }}" title="Visualizar los datos del empleado">{{ $DataMovement?->supplier?->person?->name ?? 'N/A' }} <i class="fi fi-br-share-square"></i></a></p>
            <p>Documento: <span>{{ $DataMovement?->voucher?->voucherSerie?->voucherType?->name ?? 'N/A' }}</span></p>
            <p>Tipo: <span>{{ $DataMovement?->voucher?->payment_type ?? 'N/A' }}</span></p>
            <p>Fecha de Emisión: <span>{{ $DataMovement?->voucher?->issuance_date ? \Carbon\Carbon::parse($DataMovement?->voucher?->issuance_date)->format('d/m/Y') : 'N/A' }}</span></p>
            @if (strtolower($DataMovement?->voucher?->payment_type ?? 'N/A') == 'credito')
                <p>Fecha de Vencimiento:
                    <span>{{ $DataMovement?->voucher?->expiration_date ? \Carbon\Carbon::parse($DataMovement?->voucher?->expiration_date)->format('d/m/Y') : 'N/A' }}</span>
                </p>
            @endif

        </div>
    </div>
@endif
@if ($DataMovement?->commentary || $DataMovement?->reason)
    <div class="data-comentary-and-reason">
        @if ($DataMovement?->commentary)
            <p>Comentario: <span>{{ $DataMovement->commentary }}</span></p>
        @endif
        @if ($DataMovement?->reason)
            <p>Razón: <span>{{ $DataMovement->reason }}</span></p>
        @endif
    </div>
@endif
<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-receipt'></i>
            <h3>Lista</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Suministro</th>
                    <th>Cantidad</th>
                    <th>Pecio</th>
                    <th>Sub Total</th>
                    @if ($Data['isNote'] || $Data['isEdit'])
                        <th>Opciones</th>
                    @endif
                </tr>
            </thead>

            <tbody>

                @foreach ($MovementDetail as $movementDetail)
                    <tr>
                        <td>{{ $movementDetail->supply->name }}</td>
                        <td>{{ $movementDetail->quantity }}</td>
                        <td>{{ $movementDetail->price }}</td>
                        <td>{{ $movementDetail->total_amount }}</td>
                        
                        @if ($Data['isNote'] || $Data['isEdit'])
                            <td style="width: 180px;">
                                @if ($Data['isEdit'])
                                    <button class="button-option-employee edit" onclick="editSupplyData({'name':'{{ $movementDetail->supply->name }}','quantity':{{ $movementDetail->quantity }},'price':{{ $movementDetail->price }},'idSupply':{{ $movementDetail->supply->id }},'id':{{ $movementDetail->id }}})" title="Editar datos del Suministro">
                                        <i class="fi fi-sr-user-pen option-table"></i>
                                    </button>
                                @endif

                                @if ($movementDetail->note)
                                    <button class="button-option-employee note" onclick="showNoteAlert('{{ $movementDetail->note }}')" title="Ver nota del Suministro">
                                        <i class="fi fi-ss-notebook option-table"></i>
                                    </button>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
                <script>
                    function showNoteAlert(note) {
                        Swal.fire({
                            title: 'Nota del Suministro',
                            text: note,
                            icon: 'info',
                            confirmButtonText: 'Cerrar',
                            didOpen: urlPostDeleteStyle
                        });
                    }
                </script>
            </tbody>
        </table>

    </div>
</div>
<script src="{{ asset($SearchBoxTemplate) }}"></script>
<script src="{{ asset($MovementDetailEditAndDelete) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
