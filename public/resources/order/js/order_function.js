const URL_TEMPLATE = "/resources/order/template/";
const selectedItems = [];
let idArrayCounter = selectedItems.length > 0 ? selectedItems[selectedItems.length - 1].id_array + 1 : 1;

async function loadTableDataItem(id, text = null) {
    const tablesList = document.getElementById('tables-list');
    const tableData = await consultDataUrl("/list_item_filt_category", { 'id': id });
    const url = URL_TEMPLATE + "item_frame.html";

    tablesList.innerHTML = '';

    tableData.forEach(data => {
        fetch(url)
            .then(response => response.text())
            .then(template => {
                let htmlContent = template
                    .replaceAll('{{id}}', data.id)
                    .replace('{{name}}', data.name)
                    .replaceAll('{{display_order}}', data.display_order)
                    .replace('{{price}}', data.price)
                    .replace(
                        '{{image}}',
                        "https://chewinghappiness.com/wp-content/uploads/elementor/thumbs/Pollo-a-la-braza-1-1-q8niykr5rij1m5l9rmbufgj2tsi010f6hp22hmt3xs.jpg"
                    );

                tablesList.insertAdjacentHTML('beforeend', htmlContent);
            })
            .catch(error => console.error('Error loading template:', error));
    });
}

document.getElementById('tables-list').addEventListener('click', async (event) => {
    const item = event.target.closest('.item-data');
    if (!item) return;

    const id = item.id || "0";
    const name = item.querySelector('h2')?.innerText || "Sin nombre";
    const rawPrice = item.querySelector('#price')?.innerText || "0";
    const price = parseFloat(rawPrice.replace(/[^0-9.]/g, '') || "0").toFixed(2);

    const saleElement = document.querySelector('#data');
    const saleValue = saleElement?.getAttribute('x:sale') || "0";
    const codeValue = saleElement?.getAttribute('x:code') || "Sin código";

    const data = await alertSelectItem({
        quantity: 1,
        isDelivery: false,
        note: selectedItems.filter(entry => entry.id === id).at(-1)?.note || null
    });

    if (data && data.result) {
        const existingItem = selectedItems.find(entry => entry.id === id && entry.note === data.note && entry.isDelivery === data.isDelivery);

        if (existingItem) {
            existingItem.quantity += parseInt(data.quantity, 10);
        } else {
            selectedItems.push({ idArray: idArrayCounter++, id, name, price, quantity: parseInt(data.quantity, 10), note: data.note, isDelivery: data.isDelivery });
        }

        await addTableItem(id, codeValue, saleValue);
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
                <div class="item-detail-client" id="item-${item.idArray}">
                    <div class="item-details">
                        <span>${item.name}</span>
                        <span class="label-able">Id:${item.id}</span>
                        <p class="p-sub-text">${item.quantity} Unidad(es) en s/ ${item.price} </p>
                    </div>
                    <div class="price-detail">s/ ${item.price * item.quantity}</div>

                    <div class="hover-message-item">
                        ¡Nuevo mensaje para mostrar!
                    </div>
                </div>
                `;
            });

            htmlContent = htmlContent.replace('<div id="data-item-client">', `<div id="data-item-client">${itemsContent}`);

            const referenceElement = document.getElementById('puntoClave');
            referenceElement.innerHTML = '';
            referenceElement.innerHTML = htmlContent;
            console.log('Completado');
            $('.item-detail-client').hover(
                function () {
                    $(this).find('.hover-message-item').css({
                        opacity: 1,
                        visibility: 'visible',
                        backgroundColor: 'rgba(107, 43, 43, 0.9)'
                    });
                },
                function () {
                    $(this).find('.hover-message-item').css({
                        opacity: 0,
                        visibility: 'hidden'
                    });
                }
            );
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

async function alertSelectItem(data = null) {
    const url = `${URL_TEMPLATE}order_item_select.html`;
    const htmlContent = await loadHtmlFromFile(url);

    return Swal.fire({
        html: htmlContent,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Agregar",
        didOpen: (popup) => {
            if (typeof urlPostDeleteStyle === 'function') {
                urlPostDeleteStyle(popup);
            }
            $(popup).find('.swal2-close').css('display', 'block');

            if (data) {
                $(popup).find('input[name="quantity-item"]').val(data.quantity);
                $(popup).find('#is-delivery').prop('checked', data.isDelivery);
                $(popup).find('#comment-input').val(data.note);
            }
        },
        preConfirm: () => {
            const quantity = $('input[name="quantity-item"]').val();
            const isDelivery = $('#is-delivery').is(':checked');
            const note = $('#comment-input').val();

            if (!quantity || isNaN(quantity) || quantity <= 0) {
                Swal.showValidationMessage("Por favor, ingresa una cantidad válida.");
                return false;
            }

            return {
                quantity: parseInt(quantity, 10),
                isDelivery,
                note
            };
        }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            return {
                result: true,
                ...result.value
            };
        } else {
            return { result: false };
        }
    });
}
$(document).ready(function () {
    alertSelectItem();
});
function clearComentDataAlert() {
    $('#comment-input').val('');
}

