
var order = [];

var sortable = new Sortable(document.getElementById('sortable'), {
    animation: 200,
    onStart: function (evt) {
        evt.item.style.backgroundColor = 'var(--seelct-move)';
    },
    onEnd: function (evt) {
        evt.item.style.backgroundColor = '';
        updateDisplayOrder();
        order = [];
        $('.new-item').show();
        document.querySelectorAll('#sortable tr').forEach((row, index) => {
            order.push({
                id: row.getAttribute('data-id'),
                display_order: index + 1
            });
        });
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

    console.log(orderObject);


    fetch('/edit_to_order_categori', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(orderObject)
    })
        .then(response => response.json())
        .then(data =>$('.new-item').hide())
        .catch(error => console.error('Error:', error));

}

async function addRow() {
    var name = document.getElementById('name').value;
    var quantity = parseInt(document.getElementById('order-number').value);

    if (!name.trim()) {
        alert('El nombre de la categoría es obligatorio.');
        return;
    }

    const data = await consultDataUrl('/new_menu_categories', { 'name': name, 'display_order': quantity })
    document.getElementById('name').value = '';
    document.getElementById('order-number').value = null;

    if (data.response) {

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
        alert('Tubimos un error en el registro.');
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
