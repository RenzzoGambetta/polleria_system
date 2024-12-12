const URL_TEMPLATE = "/resources/order/template/";
const saleElement = document.querySelector('#data');
const saleValue = saleElement?.getAttribute('x:sale') || "0";
const codeValue = saleElement?.getAttribute('x:code') || "Sin código";

let selectedItems = [];
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

    const data = await alertSelectItem({
        quantity: 1,
        isDelivery: isBar ? 1 : 0,
        note: selectedItems.filter(entry => entry.id === id).at(-1)?.note || null
    });

    if (data && data.result) {

        selectedItems = (selectedItems && selectedItems.length > 0) ? selectedItems.filter(item => item.quantity > 0) : selectedItems;
        const existingItem = selectedItems.find(entry => entry.id === id && entry.note === data.note && entry.isDelivery === data.isDelivery);

        if (existingItem) {
            existingItem.quantity += parseInt(data.quantity, 10);
        } else {
            selectedItems.push({ idArray: idArrayCounter++, id, name, price, quantity: parseInt(data.quantity, 10), note: data.note, isDelivery: data.isDelivery });
        }

        await addTableItem(codeValue, saleValue);
    }
});


async function addTableItem(code, sale) {
    var url = URL_TEMPLATE + "select_to_table.html";

    fetch(url)
        .then(response => response.text())
        .then(template => {
            let htmlContent = template
                .replaceAll('{{lounge}}', sale)
                .replaceAll('{{table}}', code)
                .replace('{{styleIsBar}}', isBar ? 'display: none' : '')
                .replaceAll('{{total}}', calculateTotal());
                
            let itemsContent = '';
            selectedItems.forEach(item => {
                let optionProduct = item.isDelivery === true ? 'Delivery' : 'Mesa';
                let colorOptionProduct = item.isDelivery === true ? '#720000b3' : '#0030c2b3';
                itemsContent += `
                  <div class="item-detail-client" id="item-${item.idArray}">
                    <div class="item-details">
                        <span>${item.name}</span>
                        <span class="label-able" style="background-color:${colorOptionProduct};">${optionProduct}</span>
                        <p class="p-sub-text list-text-quantity" id="text-info-data-${item.idArray}">${item.quantity} Unidad(es) en s/ ${item.price} </p>
                        <p class="p-sub-note">Nota: ${item.note ? item.note.length > 30 ? item.note.substring(0, 30) + "..." : item.note : "sin nota"}</p>
                    </div>
                    <div class="price-detail" id="sub-total-price-${item.idArray}">s/ ${item.price * item.quantity}</div>

                    <div class="hover-message-item">
                        <div class="div-input-data-cuantity-product">
                            <button class="option-min-lis-quantity" onclick="minItemList(${item.idArray})">-</button>
                            <input type="number" class="quantity-product-list" id="quantity-product-edit-${item.idArray}" value="${item.quantity}">
                            <button class="option-sum-lis-quantity" onclick="sumItemList(${item.idArray})">+</button>
                        </div>
                        <div class="button-option-list-product">
                            <button class="button-edit-list" onclick="editItemList(${item.idArray})"><i class="fi fi-sr-pencil center-icon"></i></button>
                            <button class="button-delate-list" onclick="deleteItemList(${item.idArray})"><i class="fi fi-sr-trash center-icon"></i></button>
                        </div>
                    </div>
                </div>

                `;
            });

            htmlContent = htmlContent.replace('<div id="data-item-client">', `<div id="data-item-client">${itemsContent}`);

            const referenceElement = document.getElementById('puntoClave');
            referenceElement.innerHTML = '';
            referenceElement.innerHTML = htmlContent;
            //console.log('Completado');
            $('.item-detail-client').hover(
                function () {
                    $(this).find('.hover-message-item').css({
                        opacity: 1,
                        visibility: 'visible',
                        backgroundColor: 'rgba(100 100 100)'
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

//agregar funcionalidad si el comentario es = a uno ya existente que se estoquee o si el deliveri es igual con el mismo sentido si son diferentes tipos que se muestre como diferente o separado
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

            if (data && data.type) {
                $(popup).find('.swal2-confirm.swal2-styled.swal2-default-outline').text(data.type);
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
/*
$(document).ready(function () {
    alertSelectItem();
});*/
function clearComentDataAlert() {
    $('#comment-input').val('');
}

$(document).ready(function () {

    $(document).on('input', '.quantity-product-list', function () {
        let $input = $(this);
        let currentValue = parseInt($input.val()) || 0;
        let id = parseInt($input.attr('id') ? $input.attr('id').replace("quantity-product-edit-", "") : "0");

        editDataItemList($input, currentValue, id)
    });

    window.sumItemList = function (id) {
        let $input = $(`#quantity-product-edit-${id}`);
        let currentValue = parseInt($input.val()) || 0;

        editDataItemList($input, currentValue + 1, id);
    };

    window.minItemList = function (id) {
        let $input = $(`#quantity-product-edit-${id}`);
        let currentValue = parseInt($input.val()) || 0;

        editDataItemList($input, currentValue - 1, id);
    };

});
function editDataItemList($input, currentValue, id) {

    let $textInfo = $(`#text-info-data-${id}`);
    let $subPriceInfo = $(`#sub-total-price-${id}`);
    let $price = $(`#price-item-data-total-product`);
    const item = selectedItems.find(row => row.idArray === id);

    if (!item) {
        console.error(`Item con id ${id} no encontrado.`);
        return;
    }
    if (currentValue >= 0) {
        $input.val(currentValue);
        item.quantity = currentValue;
        $textInfo.text(currentValue + " Unidad(es) en s/ " + item.price);
        $subPriceInfo.text("s/ " + (item.price * item.quantity));
        $price.text("s/ " + calculateTotal());
    }
}
function deleteItemList(idArray) {
    Swal.fire({
        title: "Confirme!!",
        text: "¿Desea eliminar el producto de la lista?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, no ay problema",
        didOpen: urlPostDeleteStyle

    }).then((result) => {
        if (result.isConfirmed) {
            selectedItems = selectedItems.filter(item => item.idArray !== idArray);
            $(`#item-${idArray}`).remove();
            $(`#price-item-data-total-product`).text("s/ " + calculateTotal());
        }
    });
}
async function editItemList(idArray) {

    const item = selectedItems.find(row => row.idArray === idArray);
    const data = await alertSelectItem({
        quantity: item.quantity,
        isDelivery: item.isDelivery,
        note: item.note,
        type: 'Editar'
    });

    if (data && data.result) {
        if (item) {
            item.quantity = data.quantity;
            item.isDelivery = data.isDelivery;
            item.note = data.note;
        }
        await addTableItem(codeValue, saleValue);
    }
}

function sendSegmentedData() {

    const csrfToken = document.querySelector('input[name="_token"]').value;

    Data = {
        table_id: saleElement?.getAttribute('x:id') || null,
        waiter_id : 1, //nc de donde sacarlo eso te mandaria
        is_delibery: isBar ? 1 : 0, //por defecto false por lo que contiene una mesa
        commentary: '',
        menu_item_ids: selectedItems.map(item => item.id),
        prices: selectedItems.map(item => item.price),
        quantities: selectedItems.map(item => item.quantity),
        total_prices: selectedItems.map(item => item.price * item.quantity),
        is_delibery_details: selectedItems.map(item => item.isDelivery ? 1 : 0),
        notes: selectedItems.map(item => item.note)
    }

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/create_order_client';

    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    Object.entries(Data).forEach(([key, value]) => {
        if (Array.isArray(value)) {
            value.forEach((item, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `${key}[]`;
                input.value = item;
                form.appendChild(input);
            });
        } else {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = value;
            form.appendChild(input);
        }
    });

    document.body.appendChild(form);
    form.submit();
}
