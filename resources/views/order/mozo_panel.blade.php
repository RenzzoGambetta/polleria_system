<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderMozo)
<!---------------------------------------------------------------------->
<script src="{{ asset($AlertSrc) }}"></script>
<link rel="stylesheet" href="{{ asset($TableEditAndRegister) }}">
<link rel="stylesheet" href="{{ asset($TableMozoPanel) }}">

<div class="header">
    <div class="left">
        <h1 id="title">Salas :</h1>
    </div>
</div>

<div class="conteiner-table">
    @foreach ($Lounge as $lon)
    <div class="tables-list">
        <div class="table-item" id="lounge_{{$lon->id}}">
            <div class="table-info">
                <i class="fi fi-sr-table-pivot table-add"></i>
                <span class="span-data-table">{{$lon->name}}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    $(document).ready(function() {
    $('.table-item').on('click', function() {
        const itemId = $(this).attr('id');
        const idValue = itemId.replace('lounge_', '');
        if (idValue) {
            window.location.href = `/table_to_mozo?lounge_id=${idValue}`;
        }
    });
});
</script>


<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
