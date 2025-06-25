var selectEditId = false;
var selectEditId;
var isEdit = false;

async function addRow() {
    const name = document.getElementById('name').value.trim();
    const ip = document.getElementById('ip').value.trim();
    const port = document.getElementById('port').value.trim();
    const state = document.getElementById('state').checked ? 1 : 0;

    if (!name || !ip || !port) {
        Swal.fire({
            icon: 'error',
            title: 'Campos requeridos',
            text: 'Completa todos los campos antes de guardar.',
            didOpen: urlPostDeleteStyle
        });
        return;
    }

    const data = await consultDataPost('/new_command_cooking_place', { name, ip, port, state });

    if (data.response) {
        $('.div-primary-conteiner-02').slideUp(500);
        document.querySelector('.container-data-table').classList.remove('shrink');
        document.getElementById('name').value = '';
        document.getElementById('ip').value = '';
        document.getElementById('port').value = '9100';
        document.getElementById('state').checked = true;

        const newRow = document.createElement('tr');
        newRow.setAttribute('data-id', data.id);
        newRow.innerHTML = `
            <td class="name"><p id="name-commad_${data.id}">${data.name}</p></td>
            <td>
                <div class="div-ip-and-port">
                    <i class="fi fi-ss-ethernet center-to-icon-table"></i>
                    <p id="ip-commad_${data.id}">${data.ip}</p>
                </div>
            </td>
            <td>
                <div class="div-ip-and-port">
                    <i class="fi fi-ss-system-cloud center-to-icon-table"></i>
                    <p id="port-commad_${data.id}">${data.port}</p>
                </div>
            </td>
            <td>
                <p class="state-data ${data.state == 1 ? 'active-data' : 'inactive-data'}" id="state-commad_${data.id}">
                    ${data.state == 1 ? 'Activo' : 'Inactivo'}
                </p>
            </td>
            <td class="center-btn-options">
                <button title="Ver los platos o bebidas asociasos" type="button" class="btn-clasic view-item" onclick="testCookinPlace(${data.id})">
                    <i class="fi fi-ss-print-magnifying-glass option-table"></i>Test
                </button>
                <button title="Editar la categoria" type="button" class="btn-clasic edit-button" onclick="editCookingPlace(${data.id})">
                    <i class="fi fi-sc-pencil option-table"></i>
                </button>
                <button title="Eliminar la categoria" type="button" class="btn-clasic delete-button" onclick="deleteCategory(${data.id})">
                    <i class="fi fi-sr-trash option-table"></i>
                </button>
            </td>
        `;

        // 👉 Inserta en la primera posición
        document.getElementById('sortable').prepend(newRow);

        Swal.fire({
            icon: 'success',
            title: 'Comanda registrada',
            text: 'Se agregó correctamente la comanda.'
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo registrar la comanda.',
            didOpen: urlPostDeleteStyle
        });
    }
}



function formatearIP(input) {
    // Solo números y puntos
    input.value = input.value.replace(/[^\d.]/g, '');

    // Partes
    let partes = input.value.split('.');
    if (partes.length > 4) {
        partes = partes.slice(0, 4);
    }

    // Limitar cada parte a 3 dígitos y 255 máx
    partes = partes.map(p => {
        let num = parseInt(p);
        if (isNaN(num)) return '';
        if (num > 255) return '255';
        return num.toString();
    });

    input.value = partes.join('.');
}
function formatearPuerto() {
    let input = document.getElementById('port');
    // Solo números
    input.value = input.value.replace(/\D/g, '');

    // Limitar a 5 dígitos
    if (input.value.length > 5) {
        input.value = input.value.slice(0, 5);
    }

    // Convertir a número y limitar a 65535
    let num = parseInt(input.value);
    if (isNaN(num) || num < 0 || num > 65535) {
        input.value = '';
    } else {
        input.value = num.toString();
    }
}

function editCookingPlace(id) {
    $('.div-primary-conteiner-02').slideUp(500);
    document.querySelector('.container-data-table').classList.remove('shrink');
    setTimeout(function () {
        document.querySelector('.container-data-table').classList.add('shrink');
        $('.div-primary-conteiner-02').slideDown(500);
    }, 500)
    setTimeout(function () {
        $('#add_to_table').hide();
        $('#clear_to_input').hide();
        //lineas de texto donde tomar inforamcion
        $('#name').val($(`#name-commad_${id}`).text().trim());
        $('#ip').val($(`#ip-commad_${id}`).text().trim());
        $('#port').val($(`#port-commad_${id}`).text().trim());
        if ($(`#state-commad_${id}`).text().trim() == "Activo") {
            $('#state').prop('checked', true);
        } else {
            $('#state').prop('checked', false);
        }
        //fin de lineas
        //ocultar y mostrar
        $('#cancel_edit').show();
        $('#edit_to_category').show();
        //Sustituir texto
        $('#sub-title-category').text('Editar comanda');
        $('.sub-title-data').css('background', 'linear-gradient(to right, #e84d00, #ff7700, #ff9737)');
    }, 500)
    isEdit = true;
    selectEditId = id;
}
function cancelToEdit() {
    $('.div-primary-conteiner-02').slideUp(500);
    document.querySelector('.container-data-table').classList.remove('shrink');
    setTimeout(function () {
        document.querySelector('.container-data-table').classList.add('shrink');
        $('.div-primary-conteiner-02').slideDown(500);
    }, 500)
    setTimeout(function () {
        $('#add_to_table').show();
        $('#clear_to_input').show();
        $('#name').val('');
        $('#ip').val('');
        $('#port').val('9100');
        $('#state').prop('checked', true);
        $('#cancel_edit').hide();
        $('#edit_to_category').hide();
        $('#sub-title-category').text('Nueva comanda');
        $('.sub-title-data').css('background', 'linear-gradient(to right, #218800, #27aa00, #09c800)');
    }, 500)
}
function showNewCategoriForm() {
    const divPrimary = $('.div-primary-conteiner-02');
    const containerDataTable = document.querySelector('.container-data-table');

    if (divPrimary.is(':visible')) {
        containerDataTable.classList.remove('shrink');
        divPrimary.slideUp(500);
    } else {
        containerDataTable.classList.add('shrink');
        divPrimary.slideDown(500);
    }

    if (isEdit) {
        cancelToEdit();
        isEdit = false;
    }
}
async function acceptEdition() {
    var Data = await consultDataPost('/edit_to_cooking_place', { 'name': $('#name').val(), 'ip': $('#ip').val(), 'port': $('#port').val(), 'state': $('#state').prop('checked') });
    console.log(Data);

    if (Data.response) {

        $(`#name-commad_${selectEditId}`).text(Data.name);
        $(`#ip-commad_${selectEditId}`).text(Data.ip);
        $(`#port-commad_${selectEditId}`).text(Data.port);
        $(`#state-commad_${selectEditId}`).text(Data.state ? 'Activo' : 'Inactivo');
        $(`#state-commad_${selectEditId}`).css('background-color', Data.state ? 'green' : 'red');
        $('.div-primary-conteiner-02').slideUp(500);
        document.querySelector('.container-data-table').classList.remove('shrink');
        Swal.fire({
            icon: 'success',
            title: 'Listo',
            text: 'Se edito correctamente la comanda',
            didOpen: urlPostDeleteStyle
        });

    } else {
        Swal.fire({
            icon: 'error',
            title: 'Upps',
            text: 'Hubo un problema con el servidor, por favor intentelo de nuevo',
            didOpen: urlPostDeleteStyle
        });
    }
}
function updateOrderAfterEdit(id, newOrder) {
    const tbody = document.getElementById("sortable");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    // Encontrar la fila actual
    const currentRow = tbody.querySelector(`tr[data-id="${id}"]`);
    if (!currentRow) return;

    // Obtener el orden anterior
    const oldOrder = parseInt(currentRow.querySelector(".order").textContent);

    // Remover la fila temporalmente
    tbody.removeChild(currentRow);

    // Ajustar posiciones de las demás filas
    rows.forEach(row => {
        let rowOrder = parseInt(row.querySelector(".order").textContent);

        if (rowOrder >= newOrder && rowOrder < oldOrder) {
            row.querySelector(".order").textContent = rowOrder + 1; // Mover hacia abajo
        } else if (rowOrder <= newOrder && rowOrder > oldOrder) {
            row.querySelector(".order").textContent = rowOrder - 1; // Mover hacia arriba
        }
    });

    // Insertar la fila en la nueva posición
    let inserted = false;
    rows.forEach(row => {
        let rowOrder = parseInt(row.querySelector(".order").textContent);
        if (!inserted && rowOrder >= newOrder) {
            tbody.insertBefore(currentRow, row);
            inserted = true;
        }
    });

    // Si no se insertó en medio, se pone al final
    if (!inserted) {
        tbody.appendChild(currentRow);
    }

    // Actualizar el nuevo orden de la fila editada
    currentRow.querySelector(".order").textContent = newOrder;
}

function deleteCategory(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Recuerda que esta accion no se podrá revertir luego!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!',
        cancelButtonText: 'Cancelar',
        didOpen: urlPostDeleteStyle
    }).then(async (result) => {
        if (result.isConfirmed) {
            var Data = await consultDataPost('/delete_to_cooking_place', { 'id': id });
            if (Data.response) {
                document.querySelector(`#sortable tr[data-id="${id}"]`).remove();
                Swal.fire({
                    icon: 'success',
                    title: 'Eliminado!',
                    text: 'La categoría ha sido eliminada.',
                    didOpen: urlPostDeleteStyle
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Upps',
                    text: 'Hubo un problema con el servidor, por favor intentelo de nuevo',
                    didOpen: urlPostDeleteStyle
                });
            }
        }
    });
}
async function testCookinPlace(id) {
    // Mostrar barra de carga
    Swal.fire({
        title: 'Imprimiendo...',
        html: 'Enviando prueba a la impresora',
        allowOutsideClick: false,
        didOpen: () => {
            urlPostDeleteStyle();
            Swal.showLoading();
        }
    });

    // Espera mínima de 2 segundos (aunque la respuesta sea rápida)
    const delay = (ms) => new Promise(res => setTimeout(res, ms));

    // Ejecutar ambas en paralelo: la espera y la petición
    const [Data] = await Promise.all([
        consultDataPost('/commandTest', { 'id': id }),
        delay(2000)
    ]);

    // Luego de 2 segundos, mostrar resultado
    if (Data.response) {
        Swal.fire({
            icon: 'success',
            title: '¡Impresión exitosa!',
            text: 'La impresora respondió correctamente.',
            didOpen: urlPostDeleteStyle
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error de impresión',
            text: 'No se pudo comunicar con la impresora. Verifique la conexión e intente nuevamente.',
            didOpen: urlPostDeleteStyle
        });
    }
}

function clearToInput() {
    $('#name').val('');
    $('#ip').val('');
    $('#port').val('9100');
    $('#state').prop('checked', true);
}
