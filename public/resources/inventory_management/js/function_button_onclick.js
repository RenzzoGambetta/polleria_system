const URL_TEMPLATE = "/resources/inventory_management/template/";

function cancelPage(url) {
    //window.history.back();
    window.location.href = url;
}
function clearInput() {

    document.getElementById('comment-input').value = null;
    document.getElementById('issue-date-input').value = new Date().toISOString().slice(0, 10);
    revertSelectionChanges();
    removeAllTableBodies();
    reverseToggleDisplay()

}
async function addItems() {

    var url = URL_TEMPLATE + "template_alert_input_inventary.html";
    const htmlContent = await loadHtmlFromFile(url);


    Swal.fire({
        title: '<h1 class="title">Agregar producto</h1>',
        html: htmlContent,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: `<i id="alert_btn"> <span> Agregar</span></i> `,
        cancelButtonText: `<i id="alert_btn"><span>Cancel</span></i>`,
        cancelButtonAriaLabel: "Thumbs down",

    }).then((result) => {
        if (result.isConfirmed) {

            const product = document.querySelector('input[name="product"]:checked');
            const supplier = document.querySelector('input[name="supplier_id"]:checked');
            const productId = product ? product.value : null;
            const supplierId = supplier ? supplier.value : null;
            const productName = product ? product.nextElementSibling.textContent : null;
            const price = parseFloat(document.getElementById('price-data').value) || 0;
            const quantity = parseFloat(document.getElementById('quantity-data').value) || 1;
            const save_option = document.getElementById('checkbox-preference').checked;

            const item = {
                id: productId,
                name: productName,
                price_per_unit: price,
                quantity: quantity
            };
            if (save_option) {
                anchorProduct(productId,supplierId)
            }
            if (productId != null){
                addTableBodyAboveReference(item);
            }else{
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "No seleccionastes un producto",
                  });
            }

        } else if (result.isDismissed) {
        }
    });
    fetchRoles();
    selectorIten(".selected-iten", ".options-iten", ".option-iten");
    revertStyleDefaultAlert();


}
async function newProduct() {

    var url = URL_TEMPLATE + "new_product_alert_template.html";
    const htmlContent = await loadHtmlFromFile(url);

    Swal.fire({
        title: '<h1 class="title">Registrar nuevo producto</h1>',
        html: htmlContent,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: `<i id="alert_btn"> <span> Agregar</span></i> `,
        cancelButtonText: `<i id="alert_btn"><span>Cancel</span></i>`,
        cancelButtonAriaLabel: "Thumbs down",

    })
}

function deleteProductRow(id) {

    var rowId = 'idRow' + id;
    var row = document.getElementById(rowId);
    if (row) {
        var tbody = row.closest('tbody');
        if (tbody) {
            tbody.parentNode.removeChild(tbody);
        } else {
            console.log('No se encontró el <tbody> que contiene la fila con ID: ' + rowId);
        }
    } else {
        console.log('No se encontró la fila con ID: ' + rowId);
    }
    sumOfPrices();

}


function revertStyleDefaultAlert() {
    const bodyElement = document.querySelector('body.dark.swal2-shown.swal2-height-auto');
    if (bodyElement) {
        bodyElement.style.paddingRight = '';
    }
}
function revertSelectionChanges() {
    const selected = document.querySelector('.selected');
    const options = document.querySelector('.options');
    const subTitleDiv = document.querySelector('.sub-title-div');
    const optionList = document.querySelectorAll('.option');

    selected.classList.remove('focus-select', 'default-iten-color');
    if (options.classList.contains('active')) {
        options.classList.remove('active');
        let currentPadding = parseInt(window.getComputedStyle(options).padding) || 0;
        options.style.padding = `${currentPadding - 8}px`;
    }
    subTitleDiv.style.opacity = "0";
    selected.innerHTML = 'Seleccionar un provedor';
}

async function loadHtmlFromFile(url) {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Error al cargar el archivo HTML');
        }
        return await response.text();
    } catch (error) {
        console.error(error);
        return '';
    }
}

function sumOfPrices() {
    const priceInputs = document.querySelectorAll('.price-input-total');
    let total = 0;

    priceInputs.forEach(input => {
        total += parseFloat(input.value) || 0;
    });

    document.getElementById('total-price').textContent = total.toFixed(2);
}

var changeInterval;

function startAction(button, inputName, buttonActionIcon) {

    changeInterval = setInterval(function () {
        valueActionInput(button, inputName, buttonActionIcon);
    }, 200);
}
function stopChange() {
    clearInterval(changeInterval);
}

function updatePrice(button, type) {

    const row = button.closest('tr');
    if (!row) { return; }
    const priceInput = row.querySelector('.price-input');
    const quantityInput = row.querySelector('.quantity-input');
    const priceTotalInput = row.querySelector('.price-input-total');

    const price = parseFloat(priceInput.value) || 0;
    const quantity = parseFloat(quantityInput.value) || 0;
    const priceTotal = parseFloat(priceTotalInput.value) || 0;

    if (type === 'total') {
        const totalPrice = price * quantity;
        priceTotalInput.value = totalPrice.toFixed(1);
    } else if (type === 'unit') {
        const totalUnit = priceTotal / quantity;
        priceInput.value = totalUnit.toFixed(2);
    }
}

function valueActionInput(button, inputName, buttonActionIcon) {

    var inputQuantity = button.parentElement.querySelector('.quantity-input');
    var inputPrice = button.parentElement.querySelector('.price-input');
    var inputPriceTotal = button.parentElement.querySelector('.price-input-total');

    if (inputName === "quantity") {

        var currentValueQuantity = parseInt(inputQuantity.value, 10);

        if (buttonActionIcon === "+") {
            if (!isNaN(currentValueQuantity)) {
                inputQuantity.value = currentValueQuantity + 1;
            }
        } else if (buttonActionIcon === "-") {
            if (!isNaN(currentValueQuantity) && currentValueQuantity > 0) {
                inputQuantity.value = currentValueQuantity - 1;
            }
        }
        updatePrice(button, 'total');

    } else if (inputName === "preci") {

        var currentValuePreci = parseFloat(inputPrice.value);

        if (buttonActionIcon === "+") {
            if (!isNaN(currentValuePreci)) {
                inputPrice.value = (currentValuePreci + 0.1).toFixed(1);
            }
        } else if (buttonActionIcon === "-") {
            if (!isNaN(currentValuePreci) && currentValuePreci > 0) {
                inputPrice.value = (currentValuePreci - 0.1).toFixed(1);
            }
        }
        updatePrice(button, 'total');

    } else if (inputName === "preci-total") {

        var currentValuePreciTotal = parseFloat(inputPriceTotal.value);

        if (buttonActionIcon === "+") {
            if (!isNaN(currentValuePreciTotal)) {
                inputPriceTotal.value = (currentValuePreciTotal + 0.1).toFixed(1);
            }
        } else if (buttonActionIcon === "-") {
            if (!isNaN(currentValuePreciTotal) && currentValuePreciTotal > 0) {
                inputPriceTotal.value = (currentValuePreciTotal - 0.1).toFixed(1);
            }
        }
        updatePrice(button, 'unit');

    }
    if (!inputName) {
        console.error('Input element not found for inputName:', inputName);
    }

    sumOfPrices();

}
function addTableBodyAboveReference(item) {

    var newTbody = document.createElement('tbody');
    var url = URL_TEMPLATE + "structured_row_template.html";
    newTbody.classList.add('list-inten', 'iten');

    fetch(url)
        .then(response => response.text())
        .then(template => {
            let htmlContent = template
                .replace('{{id}}', item.id)
                .replace('{{id-input}}', item.id)
                .replace('{{id-button}}', item.id)
                .replace('{{name}}', item.name)
                .replace('{{price_total}}', item.price_per_unit * item.quantity)
                .replace('{{price_per_unit}}', item.price_per_unit)
                .replace('{{quantity}}', item.quantity);

            newTbody.innerHTML = htmlContent;

            var referenceElement = document.getElementById('puntoClave');

            referenceElement.parentNode.insertBefore(newTbody, referenceElement.previousSibling);
        })
        .catch(error => console.error('Error loading template:', error));
}
function removeAllTableBodies() {
    const tbodies = document.querySelectorAll('tbody.list-inten.iten');
    tbodies.forEach(tbody => tbody.remove());
    sumOfPrices()
}

function supplierConsultation(event) {
    var supplierId = event.target.value;

    removeAllTableBodies();

    fetch(`/supplier_product_list?id=${supplierId}`)
        .then(response => response.json())
        .then(data => {

            const items = data.map(product => ({
                id: product.id,
                name: product.name,
                price_per_unit: product.price_per_unit,
                quantity: product.quantity
            }));
            items.forEach(item => {
                addTableBodyAboveReference(item);
            });
            setTimeout(sumOfPrices, 500);
            setTimeout(toggleDisplay, 500);


        })
        .catch(error => {
            console.error('Error al obtener los productos del proveedor:', error);
        });
}

document.querySelectorAll('input[name="supplier_id"]').forEach(function (radio) {
    radio.addEventListener('change', supplierConsultation);

});
function toggleDisplay() {
    var listDataProduct = document.querySelector('.list-data-product');
    var buttonElement = document.querySelector('.element-option');
    var buttonClear = document.querySelector('.clear-option');
    var buttonRegister = document.querySelector('.register-option');
    var buttonCancel = document.querySelector('.cancel-option');
    var filter = document.querySelector('.filter');

    if (listDataProduct) {
        listDataProduct.style.display = 'inline-table';
        buttonElement.style.display = 'flex';
        buttonRegister.style.display = 'flex';
        if (buttonClear) {
            buttonClear.classList.remove('border-style-right');
            buttonClear.classList.add('border-style-left');
            buttonCancel.classList.add('option-movile-none');
        }
    }

    if (filter) {
        filter.style.display = 'none';
    }
}
function reverseToggleDisplay() {
    var listDataProduct = document.querySelector('.list-data-product');
    var buttonElement = document.querySelector('.element-option');
    var buttonRegister = document.querySelector('.register-option');
    var buttonClear = document.querySelector('.clear-option');
    var buttonCancel = document.querySelector('.cancel-option');
    var filter = document.querySelector('.filter');

    if (listDataProduct) {
        listDataProduct.style.display = 'none';
        buttonElement.style.display = 'none';
        buttonRegister.style.display = 'none';
        if (buttonClear) {
            buttonClear.classList.remove('border-style-left');
            buttonClear.classList.add('border-style-right');
            buttonCancel.classList.remove('option-movile-none');
        }
    }
    if (filter) {
        filter.style.display = 'flex';
    }
}



document.addEventListener('DOMContentLoaded', () => {
    document.body.addEventListener('input', (event) => {
        if (event.target.matches('input[type="number"]')) {

            const inputElement = event.target;
            const inputClass = inputElement.className;

            var type;
            if (inputClass == "price-input-total no-spinner input-number-style") {
                type = "unit";
            } else {
                type = "total";
            }
            updatePrice(inputElement, type)
            sumOfPrices()
        }
    });

});



function fetchRoles() {
    const url = '/list_of_products';
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            const container = document.getElementById('options-container');

            if (!container) {
                console.log("Se canselo la peticion")
                return;
            }

            container.innerHTML = '';

            data.forEach(product => {
                const label = document.createElement('label');
                label.setAttribute('for', product.name);
                label.classList.add('option-iten');
                const input = document.createElement('input');
                input.setAttribute('type', 'radio');
                input.setAttribute('id', product.name);
                input.setAttribute('name', 'product');
                input.setAttribute('value', product.id);
                const span = document.createElement('span');
                span.textContent = product.name;
                label.appendChild(input);
                label.appendChild(span);
                container.appendChild(label);
            });
        })
        .catch(error => console.error('Error al obtener los productos:', error));
}
function anchorProduct(productId, supplierId) {

    const url = '/anchor_product_provider?productId='+productId+'&supplierId='+supplierId;

    fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log('Datos recibidos:', data);
    })
    .catch(error => {
        console.error('Error:', error);
    });


}
async function newSupplierRegistrationFast(){

    var url = URL_TEMPLATE + "new_product_alert_template.html";
    const htmlContent = await loadHtmlFromFile(url);

    Swal.fire({
        title: '<h1 class="title">Registrar nuevo producto</h1>',
        html: "hol",
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: `<i id="alert_btn"> <span> Agregar</span></i> `,
        cancelButtonText: `<i id="alert_btn"><span>Cancel</span></i>`,
        cancelButtonAriaLabel: "Thumbs down",

    })
}
