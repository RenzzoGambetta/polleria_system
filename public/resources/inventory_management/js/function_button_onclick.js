const URL_TEMPLATE = "/resources/inventory_management/template/";
var changeInterval;

function cancelPage(url) {
    //window.history.back();
    window.location.href = url;
}
function clearInput() {

    document.getElementById('series').value = null;
    document.getElementById('numeric').value = null;
    document.getElementById('search-supplier').value = null;
    document.getElementById('id-supplier').value = null;
    document.getElementById('comment-input').value = null;
    document.getElementById('dateTime').value = new Date().toISOString().slice(0, 10);
    //revertSelectionChanges();
    removeAllTableBodies();
    reverseToggleDisplay()

}
async function addItems() {

    var url = URL_TEMPLATE + "template_alert_input_inventary.html";
    const htmlContent = await loadHtmlFromFile(url);


    Swal.fire({
        title: '<h1 class="title">Agregar Suministro</h1>',
        html: htmlContent,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: `<i id="alert_btn"> <span> Agregar</span></i> `,
        cancelButtonText: `<i id="alert_btn"><span>Cancel</span></i>`,
        cancelButtonAriaLabel: "Thumbs down",
        didOpen: urlPostDeleteStyle

    }).then((result) => {
        if (result.isConfirmed) {

            //const supply = document.querySelector('input[name="supply"]:checked');
            const supplier = document.querySelector('input[name="supplier_id"]:checked');
            //const supplyId = supply ? supply.value : null;
            const supplierId = supplier ? supplier.value : null;
            //const supplyName = supply ? supply.nextElementSibling.textContent : null;

            const supplyName = document.getElementsByName('supply_name')[0]?.value || null;
            const supplyId = parseInt(document.getElementsByName('id_supply_name')[0]?.value) || null;
            const price = parseFloat(document.getElementById('price-data').value) || 0;
            const quantity = parseFloat(document.getElementById('quantity-data').value) || 1;
            const save_option = document.getElementById('checkbox-preference-input').checked;

            const item = {
                id: supplyId,
                name: supplyName,
                price_per_unit: price,
                quantity: quantity
            };
            if (save_option & supplyId != null) {
                var rpta = anchorsupply(supplyId, supplierId);
                console.log(rpta);
            }
            if (supplyId != null) {
                addTableBodyAboveReference(item);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "No seleccionastes un supplyo o no esta escrito bien",
                    didOpen: urlPostDeleteStyle
                });
            }

        } else if (result.isDismissed) {
        }
    });

    const apiUrl = '/list_of_supplys';
    new SearchBox('No se encuntro el producto...', '.search-box', '#search', '#search-label', '.suggestions', '#loader', '#id-supply', apiUrl, 5, 0);
    //fetchRoles();
    //selectorIten(".selected-iten", ".options-iten", ".option-iten");
    revertStyleDefaultAlert();
    $(document).ready(function () {
        $('#checkbox-preference-input').change(function () {
            updateLabelColor();
        });
    });

}
async function newSupply() {

    var url = URL_TEMPLATE + "new_supply_alert_template.html";
    const htmlContent = await loadHtmlFromFile(url);

    Swal.fire({
        title: '<h1 class="title">Registrar nuevo supplyo</h1>',
        html: htmlContent,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: `<i id="alert_btn"> <span> Agregar</span></i> `,
        cancelButtonText: `<i id="alert_btn"><span>Cancel</span></i>`,
        cancelButtonAriaLabel: "Thumbs down",
        didOpen: urlPostDeleteStyle

    }).then(async (result) => {
        if (result.isConfirmed) {

            const newsupplyName = document.getElementsByName('name_new_supply')[0]?.value || null;
            const newsupplyQuantity = document.getElementsByName('quantity_new_supply')[0]?.value || null;
            const newsupplyPrice = document.getElementsByName('price_new_supply')[0]?.value || null;

            const isStock = document.getElementsByName('is_stock')[0]?.checked || false;
            const saveOption = document.getElementsByName('save_option')[0]?.checked || false;

            const measurementSystem = document.querySelector('input[name="measurement_system"]:checked');
            const measurementSystemValue = measurementSystem ? measurementSystem.value : null;

            const data = {
                name: newsupplyName,
                unit_measure: measurementSystemValue,
                is_stockable: isStock,
                save_option: saveOption,
            };
            if (newsupplyName != null & newsupplyQuantity != null & newsupplyPrice != null & measurementSystemValue != null) {
                const result = await querySearchGet("/register_new_supply", data);
                console.log(result);
                if (result.response === true) {
                    const item = {
                        id: result.id,
                        name: result.name,
                        price_per_unit: newsupplyPrice,
                        quantity: newsupplyQuantity
                    };
                    addTableBodyAboveReference(item);
                    quickAlert("success", "Se registro exitosamente", "Listo")
                } else {
                    quickAlert("error", "No seleccionastes un supplyo o no esta escrito bien", "Oops...")
                }
            } else {
                quickAlert("error", "Dejastes algunos campos vacíos", "Oops...")
            }
            sumOfPrices();
        }
        else if (result.isDismissed) {
            console.log("Se canselo el registro")
        }
    });
    selectorIten(".selected-unit-of-measurement-supply-new", ".options-unit-of-measurement-supply-new", ".option-unit-of-measurement-supply-new");
    $(document).ready(function () {
        $('#checkbox-preference-input').change(function () {
            updateLabelColor();
        });
    });

}
function quickAlert(icon, text, title) {
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
        didOpen: urlPostDeleteStyle
    });
}
async function querySearchGet(url, dataCompact) {
    const queryParams = new URLSearchParams(dataCompact).toString();
    const ref = url + `?${queryParams}`;

    try {
        const response = await fetch(ref);
        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.statusText);
        }
        const data = await response.json();
        return data;

    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}
function updateLabelColor() {
    if ($('#checkbox-preference-input').is(':checked')) {
        $('label.text-adapt-item').css('color', 'red');
    } else {
        $('label.text-adapt-item').css('color', 'green');
    }
}
function deletesupplyRow(id) {

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
                .replaceAll('{{id}}', item.id)
                .replace('{{name}}', item.name)
                .replace('{{price_total}}', (item.price_per_unit * item.quantity) % 1 === 0 ? (item.price_per_unit * item.quantity).toFixed(0) : (item.price_per_unit * item.quantity).toFixed(2))
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
function supplierConsultation(id) {
    var supplierId = id;
    removeAllTableBodies();

    fetch(`/supplier_supply_list?id=${supplierId}`)
        .then(response => response.json())
        .then(data => {

            const items = data.map(supply => ({
                id: supply.id,
                name: supply.name,
                price_per_unit: supply.price_per_unit,
                quantity: supply.quantity
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

function toggleDisplay() {
    var listDatasupply = document.querySelector('.list-data-supply');
    var buttonElement = document.querySelector('.element-option');
    var buttonClear = document.querySelector('.clear-option');
    var buttonRegister = document.querySelector('.register-option');
    var buttonCancel = document.querySelector('.cancel-option');
    var filter = document.querySelector('.filter');

    if (listDatasupply) {
        listDatasupply.style.display = 'inline-table';
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
    var listDatasupply = document.querySelector('.list-data-supply');
    var buttonElement = document.querySelector('.element-option');
    var buttonRegister = document.querySelector('.register-option');
    var buttonClear = document.querySelector('.clear-option');
    var buttonCancel = document.querySelector('.cancel-option');
    var filter = document.querySelector('.filter');

    if (listDatasupply) {
        listDatasupply.style.display = 'none';
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
/* funcion remplasada por search_box_template

function fetchRoles() {
    const url = '/list_of_supplys';
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

            data.forEach(supply => {
                const label = document.createElement('label');
                label.setAttribute('for', supply.name);
                label.classList.add('option-iten');
                const input = document.createElement('input');
                input.setAttribute('type', 'radio');
                input.setAttribute('id', supply.name);
                input.setAttribute('name', 'supply');
                input.setAttribute('value', supply.id);
                const span = document.createElement('span');
                span.textContent = supply.name;
                label.appendChild(input);
                label.appendChild(span);
                container.appendChild(label);
            });
        })
        .catch(error => console.error('Error al obtener los productos:', error));
}
*/
function anchorsupply(supplyId, supplierId) {

    const url = '/anchor_supply_provider?supplyId=' + supplyId + '&supplierId=' + supplierId;

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
async function newSupplierRegistrationFast() {

    var url = URL_TEMPLATE + "new_supplier_alert_template.html";
    const htmlContent = await loadHtmlFromFile(url);

    Swal.fire({
        title: '<h1 class="title">Registrar nuevo provedor</h1>',
        html: htmlContent,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: `<i id="alert_btn"> <span> Agregar</span></i> `,
        cancelButtonText: `<i id="alert_btn"><span>Cancel</span></i>`,
        cancelButtonAriaLabel: "Thumbs down",
        didOpen: urlPostDeleteStyle


    }).then(async (result) => {
        if (result.isConfirmed) {
            const companyName = document.getElementsByName('company_name')[0]?.value || null;
            const documentNumber = document.getElementsByName('document_number')[0]?.value || null;
            const phone = document.getElementsByName('phone')[0]?.value || null;

            const dataCompact = {
                name: companyName,//company_name
                ruc: documentNumber,//document_number
                phone: phone,
            };

            if (!documentNumber || documentNumber.length < 8) {
                quickAlert("error", "El número de documento debe tener al menos 8 caracteres.")
            } else {
                if (!phone || phone.length < 9) {
                    quickAlert("error", "El número de teléfono debe tener al menos 9 dígitos.", "Oops...")
                } else {
                    if (companyName != null & documentNumber != null & phone != null) {
                        const result = await querySearchGet("/new_supplier_registration_fast", dataCompact);
                        if (result.response === true) {
                            quickAlert("success", "Se registro exitosamente el provedor", "Listo")
                        } else {
                            quickAlert("error", "No se pudo registrar el provedor", "Oops...")
                        }
                    }
                }
            }
        } else if (result.isDismissed) {
            console.log("Se canselo el registro de nuevo provedor")
        }
    });

}
document.getElementById('form-register-entry').addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
    }
});
