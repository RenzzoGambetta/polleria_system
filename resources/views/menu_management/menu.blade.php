<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($MenuTable) }}">
@csrf
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
        <h1>Menus</h1>
    </div>
</div>

<div class="action-btn-filt">
    <a href="{{ route('menu') }}?filt=1" class="not-filt {{ ($Data['button'] ?? null) == 3 ? 'active-btn' : '' }}">Todo</a>
    <a href="{{ route('menu') }}?filt=menu" class="uno-produc-filt {{ ($Data['button'] ?? null) == 2 ? 'active-btn' : '' }}">Normal</a>
    <a href="{{ route('menu') }}?filt=combo" class="combo-filt {{ ($Data['button'] ?? null) == 1 ? 'active-btn' : '' }}">Combo</a>
</div>
<div class="new-item">
    <a class="a-navegation-and-action-data" href="{{ route('registro_menu', ['button_type' => $Data["button"]]) }}">+</a>
</div>
<div class="conteiner-total">
    <div class="bottom-data">
        <div class="orders">
            <table class="table-striped-columns table">
                <thead>
                    <tr>
                        <th class="title">Nombre</th>
                        <th>Precio</th>
                        <th>Tipo</th>
                        <th>Opciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($Menu as $Menus)
                        <tr>
                            <td class="title">
                                <img src="" onerror="this.onerror=null; this.src='{{ asset($GlobalImageError) }}'; this.style.objectFit='contain';" alt="">
                                {{ $Menus->name }}
                            </td>
                            <td>S/{{ $Menus->price }}</td>
                            <td>
                                @if ($Menus->is_combo == 1)
                                    <div class="div-combo">
                                        <div class="sub-div-combo-true">
                                            <samp>Combo</samp>
                                        </div>
                                    </div>
                                @else
                                    <div class="div-combo">
                                        <div class="sub-div-combo-false">
                                            <samp>Normal</samp>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="center-btn-options">
                                <button title="Editar la menu" type="button" class="btn-clasic edit-button span-center-option" onclick="urlGet('{{ route('registro_menu') }}',{'option':{{ $Menus->id }}})"><i class="fi fi-sc-pencil option-table"></i></button>
                                <button title="Eliminar la menu" type="button" class="btn-clasic delete-button" onclick="urlPostDelete('/delete_to_menu_item',{'id':{{$Menus->id}}},'Estas seguro?','Se eliminara de forma permanente el {{ $Menus->name }}')"><i class="fi fi-sr-trash option-table"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <section class="paginacion">
        {{ $Menu->onEachSide(1)->links('pagination::custom') }}
        {{ $Menu->onEachSide(1)->links('pagination::numeros') }}                                            
        {{ $Menu->onEachSide(1)->links('pagination::anterior') }}
    </section>

</div>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
