<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<div class="header">
    <div class="left">
        <h1>Registro de Entrada</h1>
        <ul class="breadcrumb">

            <a href="{{ route('inventory') }}" class="pagina">
                Inventario
            </a>
            <li>
                /
            </li>
            <a href="{{ route('show_panel_register_entry') }}" class="active">
                Registro
            </a>

        </ul>
    </div>
</div>

<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
