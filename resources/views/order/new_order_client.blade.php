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
<div class="modify-estyle">
    <div class="list_category_item">
        @foreach ($Category as $Categories)
           <button class="button-Category" title="Categoria de {{$Categories->name}}" onclick="loadTableDataItem({{$Categories->id}})">
               <span>{{$Categories->name}}</span>
           </button>

        @endforeach
    </div>
    <div class="sale-and-table">

        <div class="conteiner-table">
            <div class="tables-list" id="tables-list">

            </div>
        </div>
    </div>
    <div class="edit-panel" id="puntoClave">

        <div class="container-select-table">
            <h1 class="select-point-sale">{{$Data['sale']}} - Mesa: {{$Data['code']}}</h1>
            <div class="loader">
                <div class="loaderMiniContainer">
                    <div class="barContainer">
                        <span class="bar"></span>
                        <span class="bar bar2"></span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 101 114" class="svgIcon">
                        <circle stroke-width="7" stroke="black" transform="rotate(36.0692 46.1726 46.1727)" r="29.5497"
                            cy="46.1727" cx="46.1726"></circle>
                        <line stroke-width="7" stroke="black" y2="111.784" x2="97.7088" y1="67.7837" x1="61.7089"></line>
                    </svg>
                </div>
            </div>
            <div class="text-select-direction">
                <div class="arrow">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <samp class="span-select-table">
                    Selecciona un Categoria y un Item <samp style="color: red">*</samp>
                </samp>
            </div>
        </div>

    </div>
</div>
</div>
<script>const url = "{{route('new_order_client')}}";</script>
<script src="{{ asset($SearchBoxTemplate) }}"></script>
<script src="{{ asset($searchBoxDataCliene) }}"></script>
<script src="{{ asset($orderFunction) }}"></script>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
