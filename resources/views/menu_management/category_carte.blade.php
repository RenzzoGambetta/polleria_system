<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($MenuTable) }}">
<link rel="stylesheet" href="{{ asset($CategoryMenu) }}">

<div class="header">
    <div class="left">
        <h1>Menus</h1>
    </div>
</div>

<div class="new-item">
    <a href="{{ route('registro_menu') }}">+</a>
    <button type="button" onclick="guardarOrden()">Guardar</button>
</div>
<div class="conteiner-total">
    <div class="bottom-data">
        <div class="orders">

            <table class="table-striped-columns table">
                <thead>
                    <tr>
                        <th>Orden</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="sortable">
                    @foreach ($Category as $Categories)
                        <tr data-id="{{ $Categories->id }}">
                            <td class="order">{{ $Categories->display_order }}</td>
                            <td>S/{{ $Categories->name }}</td>
                            <td>2</td>
                            <td><button type="button" class="btn-clasic">Editar</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <section class="paginacion">
        {{ $Category->onEachSide(1)->links('pagination::custom') }}
        {{ $Category->onEachSide(1)->links('pagination::numeros') }}
        {{ $Category->onEachSide(1)->links('pagination::anterior') }}
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        // Variable para almacenar los cambios de orden
        var order = [];

        // Inicializar Sortable.js
        var sortable = new Sortable(document.getElementById('sortable'), {
            animation: 150,
            onStart: function(evt) {
                // Cambiar el color a rojo cuando se inicia el arrastre
                evt.item.style.backgroundColor = 'red';
            },
            onEnd: function(evt) {
                // Restaurar el color al soltar
                evt.item.style.backgroundColor = '';

                // Actualizar el orden visualmente en la tabla
                updateDisplayOrder();

                // Guardar el nuevo orden en la variable temporal
                order = [];
                document.querySelectorAll('#sortable tr').forEach((row, index) => {
                    order.push({
                        id: row.getAttribute('data-id'),
                        display_order: index + 1
                    });
                });
            },
            onSort: function(evt) {
                // Actualizar el valor de display_order dinámicamente mientras se arrastra
                updateDisplayOrder();
            }
        });

        // Función para actualizar visualmente el campo display_order
        function updateDisplayOrder() {
            document.querySelectorAll('#sortable tr').forEach((row, index) => {
                row.querySelector('.order').textContent = index + 1;
            });
        }

        // Función para guardar el orden cuando se presione el botón "Guardar"
        function guardarOrden() {
          console.log(order)
        }
    </script>

</div>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
