const URL_TEMPLATE = "/resources/order/template/";
const selectedItems = []; // Array para guardar los datos seleccionados

async function loadTableDataItem(id, text = null) {
    const tablesList = document.getElementById('tables-list');
    const tableData = await consultDataUrl("/list_item_filt_category", { 'id': id });
    const url = URL_TEMPLATE + "item_frame.html";

    // Eliminar los elementos previos
    tablesList.innerHTML = '';

    tableData.forEach(data => {
        fetch(url)
            .then(response => response.text())
            .then(template => {
                // Reemplazar los valores en la plantilla
                let htmlContent = template
                    .replaceAll('{{id}}', data.id)
                    .replace('{{name}}', data.name)
                    .replaceAll('{{display_order}}', data.display_order)
                    .replace('{{price}}', data.price)
                    .replace(
                        '{{image}}',
                        "https://chewinghappiness.com/wp-content/uploads/elementor/thumbs/Pollo-a-la-braza-1-1-q8niykr5rij1m5l9rmbufgj2tsi010f6hp22hmt3xs.jpg"
                    );

                // Insertar el contenido generado
                tablesList.insertAdjacentHTML('beforeend', htmlContent);
            })
            .catch(error => console.error('Error loading template:', error));
    });
}

document.getElementById('tables-list').addEventListener('click', event => {
    const item = event.target.closest('.item-data');
    if (item) {
        const id = item.id; // ID del elemento
        const name = item.querySelector('h2').innerText; // Texto del <h2>
        const rawPrice = item.querySelector('#price').innerText; // Texto del precio, por ejemplo: "S/. 50.00"
        const price = parseFloat(rawPrice.replace(/[^0-9.]/g, '')).toFixed(2); // Convertir y redondear a dos decimales
        var saleElement = document.querySelector('#data');
        var saleValue = saleElement.getAttribute('x:sale');
        var codeValue = saleElement.getAttribute('x:code');
        // Verificar si el ítem ya existe en el arreglo
        const existingItem = selectedItems.find(entry => entry.id === id);

        if (existingItem) {
            // Si el ítem ya existe, incrementar su cantidad
            existingItem.quantity += 1;
        } else {
            // Si el ítem no existe, agregarlo con cantidad inicial de 1
            selectedItems.push({ id, name, price, quantity: 1 });
        }

        // Imprimir todos los elementos seleccionados
        console.log(`Todos los seleccionados:`, selectedItems);
        addTableItem(id, codeValue, saleValue)
    }
});

async function addTableItem(id, code, sale) {
    var url = URL_TEMPLATE + "select_to_table.html";

    fetch(url)
        .then(response => response.text())
        .then(template => {
            let htmlContent = template
                .replaceAll('{{lounge}}', sale)
                .replaceAll('{{table}}', code)
                .replaceAll('{{total}}', calculateTotal());


            let itemsContent = '';

            selectedItems.forEach(item => {
                itemsContent += `
                <div class="item-detail-client">
                    <div class="item-details">
                        <span>${item.name}</span>
                        <span class="label-able">Id:${item.id}</span>
                        <p class="p-sub-text">${item.quantity} Unidad(es) en s/ ${item.price} </p>
                    </div>
                    <div class="price-detail">s/ ${item.price * item.quantity}</div>
                </div>
            `;
            });



            htmlContent = htmlContent.replace('<div id="data-item-client">', `<div id="data-item-client">${itemsContent}`);

            const referenceElement = document.getElementById('puntoClave');
            referenceElement.innerHTML = '';
            referenceElement.innerHTML = htmlContent;
        })
        .catch(error => console.error('Error loading template:', error));
}
function calculateTotal() {
    const total = selectedItems.reduce((sum, item) => {
        const itemTotal = item.quantity * parseFloat(item.price.replace('S/.', '').trim());
        return sum + itemTotal;
    }, 0);

    return total;
}
