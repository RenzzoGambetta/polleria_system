<!--Encabezado de la pagina como plantilla de todo el panel de control-->
@include($HeaderPanel)
<!---------------------------------------------------------------------->
<link rel="stylesheet" href="{{ asset($EmployeeRecordDesktop) }}">
<link rel="stylesheet" href="{{ asset($PaginationStyle) }}">
<link rel="stylesheet" href="{{ asset($InputResources) }}">
<link rel="stylesheet" href="{{ asset($StockMovement) }}">
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

<div class="mobile-option">
    <a href="{{ route('show_panel_register_output') }}" title="Nueva Salida" class="a-arrow arrow-down"><i class='bx bxs-downvote bx-rotate-180'></i></a><a href="{{ route('show_panel_register_entry') }}" title="Nueva Entrada" class="a-arrow arrow-up"><i class='bx bxs-downvote'></i></a>
</div>

<div class="header">
    <div class="left">
        <h1>Movimientos</h1>
        <ul class="breadcrumb">

            <a href="{{ route('inventory') }}" class="active">
                Movimientos
            </a>
            <li>
                /
            </li>

        </ul>
    </div>
</div>

<div class="container-option-select">
    <div class="tabs">
        <input type="radio" id="radio-1" name="tabs" value="allSupply" checked="">
        <label class="tab" for="radio-1">Todos los movimientos <i class="fi fi-sr-archive icon-image-section"></i></label>
        <input type="radio" id="radio-2" name="tabs" value="entrySupply">
        <label class="tab" for="radio-2">Solo Entradas <i class="fi fi-sr-down icon-image-section"></i></label>
        <input type="radio" id="radio-3" name="tabs" value="OutputSupply">
        <label class="tab" for="radio-3">Solo Salidas <i class="fi fi-sr-up icon-image-section"></i></label>
        <span class="glider"></span>
    </div>
</div>
<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <div class="dub-block-001">
                <span>Del</span>
                <div class="col-3 input-effect date-time">
                    <input type="date" name="start_date" id="start_date" class="effect-16" placeholder=" ">
                    <span class="focus-border"></span>
                </div>
                <span>al</span>
                <div class="col-3 input-effect date-time">
                    <input type="date" name="end_date" id="end_date" class="effect-16" placeholder=" " value="{{ date('Y-m-d') }}">
                    <span class="focus-border"></span>
                </div>
            </div>

            <div class="btn-optin desktop"><a href="{{ route('show_panel_register_output') }}" title="Nueva Salida" class="a-arrow arrow-down"><i class='bx bxs-downvote bx-rotate-180'></i></a><a href="{{ route('show_panel_register_entry') }}" title="Nueva Entrada" class="a-arrow arrow-up"><i class='bx bxs-downvote'></i></a></div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Dia</th>
                    <th>Cantidad</th>
                    <th>Monto</th>
                    <th>Provedor</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
            <script>
                const movements = @json($Movement);
                console.log(movements);

                $(document).ready(function() {
                    const tbody = $("tbody"); // Selecciona el <tbody>
                    const rowsPerPage = 10; // Número de filas por página
                    const radios = document.querySelectorAll('input[name="tabs"]'); // Obtenemos todos los radios
                    var typeMovement;
                    let currentPage = 1;
                    var filtActive = false;
                    // Convertir el objeto movements a un array y ordenar por date_order
                    const movementsArray = Object.values(movements).sort((a, b) => {
                        return new Date(b.date_order) - new Date(a.date_order); // Orden descendente
                    });

                    let orderFiltData = movementsArray; // Inicialmente todos los movimientos

                    // Función para renderizar la tabla con paginación
                    function renderTable(page) {
                        tbody.empty(); // Limpiar las filas existentes
                        const start = (page - 1) * rowsPerPage;
                        const end = start + rowsPerPage;
                        const pageData = orderFiltData.slice(start, end);

                        pageData.forEach(movement => {
                            // Crear fila <tr>
                            const row = $("<tr>");

                            // Asignar color según el tipo de movimiento
                            if (movement.type === "Entrada") {
                                row.css("color", "var(--movement-type-color-text-tr-input)");
                            } else if (movement.type === "Salida") {
                                row.css("color", "var(--movement-type-color-text-tr-output)");
                            }

                            // Crear celdas y agregarlas a la fila
                            row.html(`
                                <td class="type-movement">
                                    ${movement.type === "Entrada" ? '<i class="fi fi-br-arrow-down"></i>' : '<i class="fi fi-br-arrow-up"></i>'}
                                    ${movement.type}
                                </td>
                                <td>${movement.date}</td>
                                <td>4</td>
                                <td>s/ ${movement.total_amount}</td>
                                <td>${movement.proveedor ?? ''}</td>
                            `);

                            // Agregar fila al <tbody>
                            tbody.append(row);
                        });
                    }

                    // Función para actualizar los controles de paginación
                    function renderPagination() {
                        const totalPages = Math.ceil(orderFiltData.length / rowsPerPage);
                        const paginationContainer = $("#pagination");
                        paginationContainer.empty();

                          // Botón de flecha izquierda
                        const prevButton = $("<button>").html("<").addClass("page-button prev-button");
                        if (currentPage === 1) {
                            prevButton.prop("disabled", true);
                        }
                      
                        prevButton.on("click", function() {
                            if (currentPage > 1) {
                                currentPage--;
                                renderTable(currentPage);
                                renderPagination();
                            }
                        });
                        paginationContainer.append(prevButton);

                        // Determinar el rango de páginas a mostrar (máximo 5 páginas)
                        const pageRange = 5;
                        let startPage = Math.max(1, currentPage - Math.floor(pageRange / 2));
                        let endPage = Math.min(totalPages, startPage + pageRange - 1);

                        // Asegurar que el rango de páginas no se desborde
                        if (endPage - startPage < pageRange - 1) {
                            startPage = Math.max(1, endPage - pageRange + 1);
                        }

                        // Mostrar botones de página
                        for (let i = startPage; i <= endPage; i++) {
                            const pageButton = $("<button>").text(i).addClass("page-button");
                            if (i === currentPage) {
                                pageButton.addClass("active");
                            }
                            pageButton.on("click", function() {
                                currentPage = i;
                                renderTable(currentPage);
                                renderPagination();
                            });
                            paginationContainer.append(pageButton);
                        }

                        // Botón de flecha derecha
                        const nextButton = $("<button>").html(">").addClass("page-button next-button");
                        if (currentPage === totalPages) {
                            nextButton.prop("disabled", true);
                        }
                        nextButton.on("click", function() {
                            if (currentPage < totalPages) {
                                currentPage++;
                                renderTable(currentPage);
                                renderPagination();
                            }
                        });
                        paginationContainer.append(nextButton);
                    }

                    // Función para imprimir el valor y el contenido seleccionado
                    function printSelectedTab() {
                        const selectedValue = document.querySelector('input[name="tabs"]:checked').value;
                        const today = new Date().toISOString().split('T')[0]; // Fecha actual

                        // Inicializar las fechas por defecto
                        let startDate = $('#start_date').val();
                        let endDate = $('#end_date').val();

                        // Si 'filtActive' está activado, y las fechas están definidas, realizamos el filtro
                        if (filtActive) {
                            if (!startDate) {
                                startDate = today; // Si no hay fecha de inicio, poner hoy como valor predeterminado
                            }
                            if (!endDate) {
                                endDate = today; // Si no hay fecha de fin, poner hoy como valor predeterminado
                            }
                        }

                        // Imprimir el valor de la opción seleccionada
                        if (selectedValue === 'allSupply') {
                            orderFiltData = movementsArray;
                            typeMovement = 'Todo';
                            currentPage = 1;
                        } else if (selectedValue === 'entrySupply') {
                            if (filtActive) {
                                let filteredData = movementsArray.filter(movement => {
                                    const movementDate = new Date(movement.date_order);
                                    return movementDate >= new Date(startDate) && movementDate <= new Date(endDate);
                                });
                                orderFiltData = filteredData.filter(movement => movement.type === 'Entrada');
                            } else {
                                orderFiltData = movementsArray.filter(movement => movement.type === 'Entrada');
                            }
                            typeMovement = 'Entrada';
                            currentPage = 1;
                        } else if (selectedValue === 'OutputSupply') {
                            if (filtActive) {
                                let filteredData = movementsArray.filter(movement => {
                                    const movementDate = new Date(movement.date_order);
                                    return movementDate >= new Date(startDate) && movementDate <= new Date(endDate);
                                });
                                orderFiltData = filteredData.filter(movement => movement.type === 'Salida');
                            } else {
                                orderFiltData = movementsArray.filter(movement => movement.type === 'Salida');
                            }
                            typeMovement = 'Salida';
                            currentPage = 1;
                        }

                        renderTable(currentPage);
                        renderPagination();
                    }

                    // Escuchar cambios en las opciones de radio
                    radios.forEach(radio => {
                        radio.addEventListener('change', () => {
                            printSelectedTab(); // Imprimir cada vez que cambie la selección
                        });
                    });

                    // Escuchar cambios en las fechas
                    $('input[type="date"]').on('change', function() {
                        const startDate = $('#start_date').val();
                        const endDate = $('#end_date').val();
                        filtActive = true;

                        if (startDate && endDate) {
                            // Filtrar los movimientos según el rango de fechas
                            let filteredData = movementsArray.filter(movement => {
                                const movementDate = new Date(movement.date_order);
                                return movementDate >= new Date(startDate) && movementDate <= new Date(endDate);
                            });

                            if (typeMovement == 'Entrada' || typeMovement == 'Salida') {
                                filteredData = filteredData.filter(movement => movement.type === typeMovement);
                            }

                            console.log(`Datos filtrados: Del ${startDate} al ${endDate}`);
                            console.log(filteredData); // Imprime los movimientos filtrados

                            // Actualiza los datos filtrados y recarga la tabla y paginación
                            orderFiltData = filteredData;
                            currentPage = 1;
                            renderTable(currentPage);
                            renderPagination();
                        } else {
                            // Si las fechas están vacías, mostrar todos los movimientos (restablecer filtro)
                            if (typeMovement == 'Entrada' || typeMovement == 'Salida') {
                                orderFiltData = movementsArray.filter(movement => movement.type === typeMovement);
                            } else {
                                orderFiltData = movementsArray;
                            }
                            filtActive = false;
                            currentPage = 1;
                            renderTable(currentPage);
                            renderPagination();
                        }
                    });


                    // Inicializar la tabla y la paginación
                    renderTable(currentPage);
                    renderPagination();
                });
            </script>

        </table>
        <div id="pagination" class="pagination-container"></div>

    </div>
</div>
<style>
    .dub-block-001 {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
        font-weight: 700;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .page-button {
        padding: 8px 12px;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 20px;
        background: linear-gradient(145deg, #3498db, #2f91d3);
        /* box-shadow: 0px 2px 5px #bebebe, -2px -2px 5px #ffffff; */
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
        font-weight: 600;
        color: white;
    }

    .page-button:hover {
        background: linear-gradient(145deg, #288a00, #246700);
    }

    .page-button:disabled {
        cursor: not-allowed;
        opacity: 0.5;
        color: #b90000;
    }

    .page-button.active {
        background: #1f6e00;
        color: white;
    }
    button.page-button.prev-button,
    button.page-button.next-button {
    color: var(--dark);
    background-color: transparent;
    background: transparent;
}
button.page-button.prev-button:hover,
    button.page-button.next-button:hover {
    color: #227800;
}
    .prev-button,
    .next-button {
        font-size: 1.3rem;
    }
</style>
<!--Pie de pagina como plantilla de todo el panel de control-->
@include($FooterPanel)
<!------------------------------------------------------------>
