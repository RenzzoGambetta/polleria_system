<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($MenuTable) }}">

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
    <a class="a-navegation-and-action-data" href="{{ route('registro_menu') }}">+</a>
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
                            <td class="title">{{ $Menus->name }}</td>
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
                            <td><button type="button" class="btn-clasic" onclick="urlGet('{{ route('registro_menu') }}',{'option':{{ $Menus->id }}})">Eitar</button></td>
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
