const URL_TEMPLATE = "/resources/inventory_management/template/";

function cancelPage() {
    window.history.back();
}
function clearInput() {

    document.getElementById('comment-input').value = null;
    document.getElementById('issue-date-input').value = new Date().toISOString().slice(0, 10);
    revertSelectionChanges();
    removeAllTableBodies();


}
async function addItems() {

    var url = URL_TEMPLATE + "template_alert_input_inventary.html";
    const htmlContent = await loadHtmlFromFile(url);


    Swal.fire({
        title: '<h1 class="title">Nuevo producto</h1>',
        html: htmlContent,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: `<i class='bx bxs-face-mask' id="alert_btn"> <span> Mas info!</span></i> `,
        cancelButtonText: `<i id="alert_btn"><span>Cancel</span></i>`,
        cancelButtonAriaLabel: "Thumbs down",
    })
    revertStyleDefaultAlert()
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
    const priceInputs = document.querySelectorAll('.price-input');
    let total = 0;

    priceInputs.forEach(input => {
        total += parseFloat(input.value) || 0;
    });

    document.getElementById('total-price').textContent = total.toFixed(2);
}
document.querySelectorAll('.price-input').forEach(input => {
    input.addEventListener('input', () => {
        sumOfPrices();
    });
});
window.addEventListener('DOMContentLoaded', sumOfPrices);


var changeInterval;

function startAction(button, inputName, buttonActionIcon) {

    changeInterval = setInterval(function () {
        valueActionInput(button, inputName, buttonActionIcon);
    }, 200);
}
function stopChange() {
    clearInterval(changeInterval);
}
function valueActionInput(button, inputName, buttonActionIcon) {

    var input;

    if (inputName === "quantity") {

        input = button.parentElement.querySelector('.quantity-input');
        var currentValue = parseInt(input.value, 10);

        if (buttonActionIcon === "+") {
            if (!isNaN(currentValue)) {
                input.value = currentValue + 1;
            }
        } else if (buttonActionIcon === "-") {
            if (!isNaN(currentValue) && currentValue > 0) {
                input.value = currentValue - 1;
            }
        }
    } else if (inputName === "preci") {

        input = button.parentElement.querySelector('.price-input');
        var currentValue = parseFloat(input.value);

        if (buttonActionIcon === "+") {
            if (!isNaN(currentValue)) {
                input.value = (currentValue + 0.1).toFixed(1);
            }
        } else if (buttonActionIcon === "-") {
            if (!isNaN(currentValue) && currentValue > 0) {
                input.value = (currentValue - 0.1).toFixed(1);
            }
        }
        sumOfPrices();
    }
    if (!input) {
        console.error('Input element not found for inputName:', inputName);
    }

}
function addTableBodyAboveReference(item) {

    var newTbody = document.createElement('tbody');
    var url = URL_TEMPLATE + "structured_row_template.html";
    newTbody.classList.add('list-inten', 'iten');

    fetch(url)
        .then(response => response.text())
        .then(template => {
            let htmlContent = template
                .replace('{{name}}', item.name)
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
                name: product.name,
                price_per_unit: product.price_per_unit,
                quantity: product.quantity
            }));
            items.forEach(item => {
                addTableBodyAboveReference(item);
            });
            setTimeout(sumOfPrices, 500);
        })
        .catch(error => {
            console.error('Error al obtener los productos del proveedor:', error);
        });
}

document.querySelectorAll('input[name="supplier_id"]').forEach(function(radio) {
    radio.addEventListener('change', supplierConsultation);
});
