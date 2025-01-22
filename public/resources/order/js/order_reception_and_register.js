const URL_TEMPLATE = "/resources/order/template/";
var statusCategory = 0;
let selectedItems = [];
let idArrayCounter = selectedItems.length > 0 ? selectedItems[selectedItems.length - 1].id_array + 1 : 1;
var commentary = '';

function toggleTableDetails() {
    const panel = document.getElementById('tableDetailsPanel');
    panel.classList.toggle('open');
}

$(document).on('click', '.tables-list .table-item', function () {
    const elementId = $(this).attr('id');
    if (!elementId || !elementId.startsWith('lounge_')) {
        console.error('Error: El elemento no tiene un ID válido con el prefijo "lounge_".');
        return;
    }

    const id = elementId.replace('lounge_', '');

    if (!$.isNumeric(id)) {
        console.error('Error: El ID extraído no es un número válido.');
        return;
    }
    $('#frame-category-data').slideUp(300);

    const filteredItems = items.filter(item => item.category_id === parseInt(id)).sort((a, b) => a.display_order - b.display_order);

    let htmlContent = '';

    filteredItems.forEach(item => {
        htmlContent += `
            <div class="item-data" id="${item.id}" data-order="${item.display_order}">
                <img src="https://chewinghappiness.com/wp-content/uploads/elementor/thumbs/Pollo-a-la-braza-1-1-q8niykr5rij1m5l9rmbufgj2tsi010f6hp22hmt3xs.jpg" alt="${item.name}" draggable="false">
                <div class="item-data-info">
                    <h2>${item.name}</h2>
                    <p class="price">S/. <span id="price">${item.price}</span></p>
                </div>
            </div>
        `;
    });
    document.getElementById('item-container-select-to-category').innerHTML = htmlContent;
    var nameValue = $(`#lounge_${id}`).attr('x:name');
    $('#sub-title-category-text').fadeOut(300, function () {
        $(this).text(nameValue).fadeIn(300);
    });
    $('#icon-efect-to-category').fadeOut(300, function () {
        $(this).attr('class', 'fi fi-sr-angle-small-down center-icon').fadeIn(300);
    });
    $('#item-container-select-to-category').slideDown(300, function () {
        statusCategory = 1;
    });

});

$(document).on('click', '.frame-nav-option#button-categori-display', function () {
    if (statusCategory == 1) {
        $('#frame-category-data').slideToggle(300, function () {
            if ($(this).is(':visible')) {
                $('#item-container-select-to-category').slideUp(300);
                $('#icon-efect-to-category').fadeOut(300, function () {
                    $(this).attr('class', 'fi-sr-angle-double-small-up center-icon').fadeIn(300);
                });

            } else {

                $('#item-container-select-to-category').slideDown(300);
                $('#icon-efect-to-category').fadeOut(300, function () {
                    $(this).attr('class', 'fi fi-sr-angle-small-down center-icon').fadeIn(300);
                });
            }
        });
    }
});

document.getElementById('item-container-select-to-category').addEventListener('click', async (event) => {
    const item = event.target.closest('.item-data');
    if (!item) return;
    const id = item.id || "0";
    const itemData = items.find(data => data.id == id);
    const name = itemData.name;
    const price = itemData.price;

    const data = await alertSelectItem({
        quantity: 1,
        isDelivery: false,
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

        await addTableItem();
    }
});

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



async function addTableItem() {
    let itemsContent = '';
    selectedItems.forEach(item => {
        let optionProduct = item.isDelivery === true ? 'Delivery' : 'Mesa';
        let colorOptionProduct = item.isDelivery === true ? '#720000b3' : '#0030c2b3';
        itemsContent += `
            <div class="item-detail-client" id="item-${item.idArray}">
                <div class="item-details">
                    <span>${item.name}</span>
                    <span class="label-able" style="background-color:${colorOptionProduct};">${optionProduct}</span>
                    <p class="p-sub-text list-text-quantity" id="text-info-data-${item.idArray}">${item.quantity} Unidad(es) en s/ ${item.price}</p>
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

    const referenceElement = document.getElementById('data-item-client');
    referenceElement.innerHTML = ''; // Limpia el contenido actual
    referenceElement.innerHTML = itemsContent; // Inserta el nuevo contenido

    $('.item-detail-client').hover(
        function () {
            $(this).find('.hover-message-item').css({
                opacity: 1,
                visibility: 'visible',
                backgroundColor: 'rgba(100, 100, 100, 0.8)' // Ajusté el color para que tenga opacidad
            });
        },
        function () {
            $(this).find('.hover-message-item').css({
                opacity: 0,
                visibility: 'hidden'
            });
        }
    );
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
        await addTableItem();
    }
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
function clearComentDataAlert() {
    $('#comment-input').val('');
}


function sendSegmentedData() {

    const cantidadFilas = selectedItems.length;
    if(cantidadFilas == 0){
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "No hay productos",
            footer: `<a href="table_to_mozo?lounge_id=${id_lounge}">Quieres regresar a las mesas?</a>`,
            didOpen: (popup) => {
                if (typeof urlPostDeleteStyle === 'function') {
                    urlPostDeleteStyle(popup);
                }}
        });
        return;
    }

    const csrfToken = document.querySelector('input[name="_token"]').value;

    Data = {
        table_id: id_table,
        is_delibery: 0,
        commentary: commentary,
        type: 'mozo',
        lounge: id_lounge,
        menu_item_ids: selectedItems.map(item => item.id),
        prices: selectedItems.map(item => item.price),
        quantities: selectedItems.map(item => item.quantity),
        total_prices: selectedItems.map(item => item.price * item.quantity),
        is_delibery_details: selectedItems.map(item => item.isDelivery),
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
async function noteDetailOrder() {

    const url = `${URL_TEMPLATE}commentary_order_total.html`;
    const htmlContent = await loadHtmlFromFile(url);

    Swal.fire({
        html: htmlContent,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Agregar",
        cancelButtonText: "Cancelar",
        didOpen: (popup) => {
            if (typeof urlPostDeleteStyle === 'function') {
                urlPostDeleteStyle(popup);
            }
            $(popup).find('#comment-input').val(commentary);
        },
    }).then((result) => {
        if (result.isConfirmed) {
            const noteValue = document.getElementById("comment-input").value;
            commentary = noteValue;
        
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            console.log("Acción cancelada");
        }
    });
}

