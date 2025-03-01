
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
                    <td class="order">${insertPosition + 1}</td>
                    <td>${data.name}</td>
                    <td>0</td>
                    <td><button type="button" class="btn-clasic">Editar</button></td>
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
function editCategoryCarte(Data) {
    $('.div-primary-conteiner-02').slideUp(500);
    document.querySelector('.container-data-table').classList.remove('shrink');
    setTimeout(function () {
        document.querySelector('.container-data-table').classList.add('shrink');
        $('.div-primary-conteiner-02').slideDown(500);
    }, 500)
    setTimeout(function () {
        $('#add_to_table').hide();
        $('#clear_to_input').hide();
        $('#order-number').val(Data.display_order);
        $('#name').val(Data.name);
        $('#cancel_edit').show();
        $('#edit_to_category').show();
        $('#sub-title-category').text('Editar categoria');
        $('.sub-title-data').css('background', 'linear-gradient(to right, #e84d00, #ff7700, #ff9737)');
    }, 500)
    isEdit = true;
    selectEditId = Data;
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
    var Data = await consultDataPost('/edit_to_category', { 'id': selectEditId.id, 'name': $('#name').val(), 'display_order': $('#order-number').val() });
    console.log(Data);
     if (Data.response) {
        Swal.fire({
            icon: 'success',
            title: 'Editado correctamente',
            text: 'La categoría ha sido actualizada.',
            confirmButtonText: 'OK',
            didOpen: urlPostDeleteStyle

        }).then(() => {
            location.reload(); // Recarga la página al presionar OK
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