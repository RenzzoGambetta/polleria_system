var order = [];
var isEdit = false;
var selectEditId;

var sortable = new Sortable(document.getElementById('sortable'), {
    animation: 200,
    onStart: function (evt) {
        evt.item.style.backgroundColor = 'var(--seelct-move)';
        $('.div-primary-conteiner-02').slideUp(500);
        document.querySelector('.container-data-table').classList.remove('shrink');
    },
    onEnd: function (evt) {
        evt.item.style.backgroundColor = '';
        updateDisplayOrder();
        order = [];
        //$('.new-item').show();
        document.querySelectorAll('#sortable tr').forEach((row, index) => {
            order.push({
                id: row.getAttribute('data-id'),
                display_order: index + 1
            });
        });
        sectionData();
    },
    onSort: function () {
        updateDisplayOrder();
    }
});

function updateDisplayOrder() {
    document.querySelectorAll('#sortable tr').forEach((row, index) => {
        row.querySelector('.order').textContent = index + 1;
    });
}

async function sectionData() {
    var csrfToken = document.querySelector('input[name="_token"]').value;


    var orderObject = order.reduce((acc, item) => {
        acc[item.id] = item.display_order;
        return acc;
    }, {});
    //console.log(orderObject);
    fetch('/edit_to_order_categori', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(orderObject)
    })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));

}

async function addRow() {
    var name = document.getElementById('name').value;
    var orderNumber = parseInt(document.getElementById('order-number').value);

    if (!name.trim()) {
        Swal.fire({
            icon: 'error',
            title: 'Upps',
            text: 'El nombre es obligatorio',
            didOpen: urlPostDeleteStyle
        }); 
        return;
    }

    const data = await consultDataPost('/new_menu_categories', { 'name': name, 'display_order': orderNumber })
    console.log(data);
    if (data.response) {
        $('.div-primary-conteiner-02').slideUp(500);
        document.querySelector('.container-data-table').classList.remove('shrink');
        document.getElementById('name').value = '';
        document.getElementById('order-number').value = null;

        var rows = document.querySelectorAll('#sortable tr');
        var rowCount = rows.length;
        var insertPosition = (data.display_order > rowCount) ? rowCount : data.display_order - 1;

        var newRow = document.createElement('tr');
        newRow.setAttribute('data-id', data.id);
        newRow.innerHTML = `
                    <td id="order_number_${data.id}" class="order">${insertPosition + 1}</td>
                    <td id="name_category_${data.id}">${data.name}</td>
                    <td id="quantity_items_${data.id}">0</td>
                    <td>
                        <button title="Ver los platos o bebidas asociasos" type="button" class="btn-clasic view-item" onclick="urlGet('${urlOrderItem}',{'category_id':${data.id}})"><i class="fi fi-rr-overview option-table"></i>Ver Item</button>
                        <button title="Editar la categoria" type="button" class="btn-clasic" onclick="editCategoryCarte(${data.id})"><i class="fi fi-sc-pencil option-table"></i></button>
                        <button title="Eliminar la categoria" type="button" class="btn-clasic delete-button" onclick="deleteCategory(${data.id})"><i class="fi fi-sr-trash option-table"></i></button>
                    </td>                 
                `;
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Upps',
            text: 'Hubo un problema con el servidor, por favor intentelo de nuevo',
            didOpen: urlPostDeleteStyle
        }); 
    } 

    if (insertPosition < rowCount) {
        document.getElementById('sortable').insertBefore(newRow, rows[insertPosition]);
    } else {
        document.getElementById('sortable').appendChild(newRow);
    }

    for (var i = insertPosition + 1; i <= rowCount; i++) {
        rows[i - 1].querySelector('.order').textContent = i + 1;
    }

    updateDisplayOrder();
}
function editCategoryCarte(id) {
    $('.div-primary-conteiner-02').slideUp(500);
    document.querySelector('.container-data-table').classList.remove('shrink');
    setTimeout(function () {
        document.querySelector('.container-data-table').classList.add('shrink');
        $('.div-primary-conteiner-02').slideDown(500);
    }, 500)
    setTimeout(function () {
        $('#add_to_table').hide();
        $('#clear_to_input').hide();
        $('#order-number').val($(`#order_number_${id}`).text().trim());
        $('#name').val($(`#name_category_${id}`).text().trim());
        $('#cancel_edit').show();
        $('#edit_to_category').show();
        $('#sub-title-category').text('Editar categoria');
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
        $('#order-number').val('');
        $('#name').val('');
        $('#cancel_edit').hide();
        $('#edit_to_category').hide();
        $('#sub-title-category').text('Nueva categoria');
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
async function acceptEdition(){
    var orderNumber = $('#order-number').val();
    var Data = await consultDataPost('/edit_to_category', { 'id': selectEditId, 'name': $('#name').val(), 'display_order': orderNumber });
    console.log(Data);
     if (Data.response) {

        const rowCount = document.querySelectorAll("#sortable tr").length;
        if (orderNumber <= rowCount) {
            updateOrderAfterEdit(selectEditId,orderNumber);
        }else{
            Swal.fire({
                icon: 'info',
                title: 'Upss',
                text: 'El numero de orden otorgado es demaciado lejano para mantener el orden de la tabla, se asignara al final de la tabla',
                confirmButtonText: 'OK',
                didOpen: urlPostDeleteStyle
    
            }).then(() => { 
                updateOrderAfterEdit(selectEditId,rowCount);
            });  
        }
        $('.div-primary-conteiner-02').slideUp(500);
        document.querySelector('.container-data-table').classList.remove('shrink');
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

function deleteCategory(id){
    var cuantityItems = parseInt($(`#quantity_items_${id}`).text().trim());
    if (cuantityItems == 0) {
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
                var Data = await consultDataPost('/delete_to_category', { 'id': id });
                if (Data.response) {
                    document.querySelector(`#sortable tr[data-id="${id}"]`).remove();
                    updateDisplayOrder();
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
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Upps',
            text: 'Esta categoria no es posuible eliminarla ya que tiene items asociados y afectaria los datos',
            didOpen: urlPostDeleteStyle
        });
    }
}