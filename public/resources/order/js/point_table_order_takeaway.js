let currentPage = 1; // Página actual
let totalItems = 0; // Número total de items
let result = []; // Usamos `let` para permitir que esta variable sea reasignada
let orderIds = []; // Array para almacenar los IDs de las órdenes
let itemsPerPage = 0; // Número de elementos por página (se ajustará dinámicamente)
const rowHeight = 50; // Altura estimada de cada fila en píxeles (ajustar según el diseño)
let containerHeight = window.innerHeight * 0.7; // 70% de la altura de la ventana


async function listTakeawayOrder() {
    result = await consultDataUrl("/list_takeaway_orders");
    adjustItemsPerPage();
    listTakeawayOrderAction();
    $('.content main .list-delivery-order.bottom-data').css('display', 'block');
    $('.conteiner-table').css('display', 'none');
    $('.button-option-table-oreder-takeaway.order').css('background-color', '#6300ff');
    addOrder();
}

function adjustItemsPerPage() {
    itemsPerPage = Math.floor(containerHeight / rowHeight);
}

function listTakeawayOrderAction() {
    totalItems = result.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);

    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageItems = result.slice(startIndex, endIndex);

    let itemTemplate = (order, date, client, total) => `
        <tr>
            <td>º${order}</td>
            <td><i class="fi fi-sr-user"></i> ${client}</td>
            <td id="order-time-${order}" data-time="${date}">${date}</td>
            <td>s/.${total}</td>
        </tr>
    `;

    orderIds = [];
    let itemsContent = '';

    pageItems.forEach(item => {
        orderIds.push(item.order);
        let order = item.order || 'Desconocido';
        let date = item.date || 'Desconocido';
        let client = item.client || 'Desconocido';
        let total = item.total || 0;

        itemsContent += itemTemplate(order, date, client, total);
    });

    $('.tr-td-key-point').html(itemsContent);
    updateElapsedTime();
    generatePagination(totalPages, currentPage);
}

function generatePagination(totalPages, currentPage) {
    let paginationContent = '';

    if (currentPage > 1) {
        paginationContent += `<button class="pagination-button" onclick="goToPage(${currentPage - 1})">&lt;</button>`;
    } else {
        paginationContent += `<button class="pagination-button disabled">&lt;</button>`;
    }

    for (let i = 1; i <= totalPages; i++) {
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
            const orderTime = new Date(orderTimeElement.dataset.time); // Convertir la fecha desde data-time
            const currentTime = new Date(); // Obtener el tiempo actual

            const timeDiff = currentTime - orderTime; // Diferencia de tiempo en milisegundos

            const seconds = Math.floor(timeDiff / 1000);
            const minutes = Math.floor(seconds / 60);
            const hours = Math.floor(minutes / 60);
            const days = Math.floor(hours / 24);

            let timeString = "";

            // Dependiendo de la cantidad de tiempo transcurrido, actualizamos el texto
            if (seconds < 60) {
                timeString = `<i class="fi fi-sr-clock-three"></i> ${seconds} segundos`;
            } else if (minutes < 60) {
                timeString = `<i class="fi fi-rr-clock-three"></i> ${minutes} minutos`;
            } else if (hours < 24) {
                timeString = `<i class="fi fi-rr-clock-seven"></i> ${hours} horas`;
            } else {
                timeString = `<i class="fi fi-ss-hourglass"></i> ${days} días`;
            }

            // Usamos innerHTML para actualizar el contenido con HTML (incluyendo los íconos)
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

async function addOrder(text) {
    var url = URL_TEMPLATE + "select_to_lounges.html";

    fetch(url)
        .then(response => response.text())
        .then(template => {
            let htmlContent = template
                .replaceAll('{{name}}', text);

            const referenceElement = document.getElementById('puntoClave');
            referenceElement.innerHTML = '';
            referenceElement.innerHTML = htmlContent;
            ID_SELECT = id;
            NAME_SELECT = text;
        })
        .catch(error => console.error('Error loading template:', error));
    $('.conteiner-table').show();

}
