
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

function sectionData() {

    console.log(order)

}

function addRow() {
    var name = document.getElementById('name').value;
    var quantity = parseInt(document.getElementById('order-number').value);

    if (!name.trim()) {
        alert('El nombre de la categoría es obligatorio.');
        return;
    }

    consultDataUrl('new_menu_categories',{ 'name': name, 'display_order': quantity })

    if(true){
        var rows = document.querySelectorAll('#sortable tr');
        var rowCount = rows.length;
        var insertPosition = (quantity > rowCount) ? rowCount : quantity - 1;

        var newRow = document.createElement('tr');
        newRow.setAttribute('data-id',  (rowCount + 1));
        newRow.innerHTML = `
                    <td class="order">${insertPosition + 1}</td>
                    <td>${name}</td>
                    <td>0</td>
                    <td><button type="button" class="btn-clasic">Editar</button></td>
                `;
    }else{
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
    document.getElementById('name').value = '';
    document.getElementById('order-number').value = null;

    updateDisplayOrder();
}
