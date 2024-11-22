let globalOption, currentPage = 1, totalItems = 0, result = [], resultFilt = [], orderIds = [], itemsPerPage = 0, containerHeight = window.innerHeight * 0.7, action = 0;
const rowHeight = 50;


async function listTakeawayOrder() {
    action = 0;
    await functionActionbutonPost("order");
    adjustItemsPerPage();
    listTakeawayOrderAction();
    $('#type-of-payment').css('display', 'none');
    $('.button-option-table-oreder-takeaway.order').css('background-color', '#6300ff');
    addOrder(1);
}

async function listOrdersPreparation() {
    action = 1;
    await functionActionbutonPost("preparation");
    adjustItemsPerPage();
    listTakeawayOrderAction();
    $('#type-of-payment').css('display', 'table');
    $('.button-option-table-oreder-takeaway.status').css('background-color', '#6300ff');
    addOrder(2);
}
async function listOrdersHistory() {
    action = 1;
    await functionActionbutonPost("history");
    adjustItemsPerPage();
    listTakeawayOrderAction();
    $('#type-of-payment').css('display', 'table');
    $('.button-option-table-oreder-takeaway.history').css('background-color', '#6300ff');
    addOrder(3);
}

async function functionActionbutonPost(url) {
    result = await consultDataUrl('/list_takeaway_orders', { type: url });
    resultFilt = result;
    $('.content main .list-delivery-order.bottom-data').css('display', 'block');
    $('.conteiner-table').css('display', 'none');
    $('.button-option-table-oreder-takeaway').css('background-color', '#ff5700');
    goToPage(1);
    $('#search-data').val('');
}

function adjustItemsPerPage() {
    itemsPerPage = Math.floor(containerHeight / rowHeight);
}

function listTakeawayOrderAction() {
    totalItems = resultFilt.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);

    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageItems = resultFilt.slice(startIndex, endIndex);
    let itemTemplate;

    if (action == 1) {
        itemTemplate = (id, order, date, client, pay, color, total) => `
        <tr data-id="${id}">
            <td>º${order}</td>
            <td><i class="fi fi-sr-user"></i> ${client}</td>
            <td id="order-time-${order}" data-time="${date}">${date}</td>
            <td><span class="type-pay" style="background-color:${color};">${pay}</span></td>
            <td>s/.${total}</td>
        </tr>
    `;
    } else {
        itemTemplate = (id, order, date, client, total) => `
            <tr data-id="${id}">
                <td>º${order}</td>
                <td><i class="fi fi-sr-user"></i> ${client}</td>
                <td id="order-time-${order}" data-time="${date}">${date}</td>
                <td>s/.${total}</td>
            </tr>
        `;
    }

    orderIds = [];
    let itemsContent = '';

    if (action == 1) {
        pageItems.forEach(item => {
            orderIds.push(item.order);
            let order = item.order || 'Desconocido',
                date = item.date || 'Desconocido',
                client = item.client || 'Desconocido',
                pay = item.pay || 'Desconocido',
                color = item.color || '#0fff0063',
                total = item.total || 0,
                id = item.id || 0;

            itemsContent += itemTemplate(id, order, date, client, pay, color, total);
        });
    } else {
        pageItems.forEach(item => {
            orderIds.push(item.order);
            let order = item.order || 'Desconocido',
                date = item.date || 'Desconocido',
                client = item.client || 'Desconocido',
                total = item.total || 0,
                id = item.id || 0;

            itemsContent += itemTemplate(id, order, date, client, total);
        });
    }

    $('.tr-td-key-point').html(itemsContent);
    updateElapsedTime();
    generatePagination(totalPages, currentPage);

    $(document).on('click', 'tr[data-id]', function() {
        const orderId = $(this).data('id');
        console.log(`ID de la orden: ${orderId}\ngloval option ${globalOption}`);

    });
}

function generatePagination(totalPages, currentPage) {
    let paginationContent = '';

    if (currentPage > 1) {
        paginationContent += `<button class="pagination-button" onclick="goToPage(${currentPage - 1})">&lt;</button>`;
    } else {
        paginationContent += `<button class="pagination-button disabled">&lt;</button>`;
    }

    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(totalPages, currentPage + 2);

    if (currentPage <= 3) {
        endPage = Math.min(5, totalPages);
    }
    if (currentPage >= totalPages - 2) {
        startPage = Math.max(totalPages - 4, 1);
    }

    for (let i = startPage; i <= endPage; i++) {
        paginationContent += `<button class="pagination-button ${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">${i}</button>`;
    }

    if (currentPage < totalPages) {
        paginationContent += `<button class="pagination-button" onclick="goToPage(${currentPage + 1})">&gt;</button>`;
    } else {
        paginationContent += `<button class="pagination-button disabled">&gt;</button>`;
    }

    $('.pagination-container').html(paginationContent);
}

function goToPage(page) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    if (page < 1 || page > totalPages) {
        return;
    }
    currentPage = page;
    listTakeawayOrderAction();
}

window.addEventListener('resize', () => {
    containerHeight = window.innerHeight * 0.7;
    adjustItemsPerPage();
    listTakeawayOrderAction();
});


function updateElapsedTime() {
    orderIds.forEach(orderId => {
        const orderTimeElement = document.getElementById(`order-time-${orderId}`);
        if (orderTimeElement) {
            const orderTime = new Date(orderTimeElement.dataset.time);
            const currentTime = new Date();

            const timeDiff = currentTime - orderTime;

            const seconds = Math.floor(timeDiff / 1000);
            const minutes = Math.floor(seconds / 60);
            const hours = Math.floor(minutes / 60);
            const days = Math.floor(hours / 24);

            let timeString = "";

            if (seconds < 60) {
                timeString = `<i class="fi fi-sr-clock-three"></i> ${seconds} segundos`;
            } else if (minutes < 60) {
                timeString = `<i class="fi fi-rr-clock-three"></i> ${minutes} minutos`;
            } else if (hours < 24) {
                timeString = `<i class="fi fi-rr-clock-seven"></i> ${hours} horas`;
            } else {
                timeString = `<i class="fi fi-ss-hourglass"></i> ${days} días`;
            }

            orderTimeElement.innerHTML = timeString;
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {

    orderIds.forEach(orderId => {
        const orderTimeElement = document.getElementById(`order-time-${orderId}`);
        if (orderTimeElement) {
            orderTimeElement.dataset.time = orderTimeElement.textContent;
        }
    });

    setInterval(updateElapsedTime, 1000);
});

async function addOrder(option) {
    globalOption = option;
    var url = URL_TEMPLATE + "counter_panel.html";
    var text = {
        1: 'Mostrador<br>Ordenes pendiente',
        2: 'Mostrador<br>Ordenes en preparacion',
        3: 'Mostrador<br>Historial de ordenes'
    }[option] || 'Mostrador';

    fetch(url)
        .then(response => response.text())
        .then(template => {
            let htmlContent = template
                .replaceAll('{{text}}', text);

            const referenceElement = document.getElementById('puntoClave');
            referenceElement.innerHTML = '';
            referenceElement.innerHTML = htmlContent;
        })
        .catch(error => console.error('Error loading template:', error));
    $('.conteiner-table').show();

    $(document).on('click', '#button-div-option-new-order', function () {
        console.log('Se presionó Agregar');
    });

}



document.getElementById('search-data').addEventListener('input', function (event) {
    const query = event.target.value.toLowerCase();

    resultFilt = result.filter(item => {

        let order = item.order || 'Desconocido';
        let date = item.date || 'Desconocido';
        let client = item.client || 'Desconocido';
        let total = item.total || 0;


        return (
            order.toLowerCase().includes(query) ||
            date.toLowerCase().includes(query) ||
            client.toLowerCase().includes(query) ||
            total.toString().includes(query)
        );
    });

    if (resultFilt.length === 0) {
        $('.loader-data-not-client').css('display', 'block');
    } else {
        $('.loader-data-not-client').css('display', 'none');
    }

    adjustItemsPerPage();
    listTakeawayOrderAction();
});
