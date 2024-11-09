const URL_TEMPLATE = "/resources/order/template/";
var ID_SELECT = 0;
var NAME_SELECT = "";
let scrollInterval;

$(document).ready(function () {
    $('.conteiner-table').hide();
});

function startAutoScroll(direction) {
    const tabsContainer = document.getElementById('tabs-container');
    scrollInterval = setInterval(() => {
        tabsContainer.scrollLeft += direction * 500;
    }, 10);
}

function stopAutoScroll() {
    clearInterval(scrollInterval);
}

async function loadTableData(id, text = null) {
    const tablesList = document.getElementById('tables-list');
    const tableData = await consultDataUrl("/tables-list-data", { 'id': id });
    var url = URL_TEMPLATE + "frame_table.html";

    tablesList.querySelectorAll('.table-item.table-data').forEach(element => element.remove());


    tableData.forEach(data => {
        fetch(url)
            .then(response => response.text())
            .then(template => {
                var color = data.status === 1 ? '#f95f5f85' : '#26f9276e';
                var isVisible = data.status === 1 ? 'block' : 'none';
                let htmlContent = template
                    .replaceAll('{{code}}', data.name)
                    .replaceAll('--status', color)
                    .replaceAll('--is-visible', isVisible)
                    .replace('{{option}}', data.status)
                    .replaceAll('{{id}}', data.id);

                tablesList.insertAdjacentHTML('beforeend', htmlContent);
            })
            .catch(error => console.error('Error loading template:', error));
    });

    highlightButton(id);
    addLounges(id, text);

}


function highlightButton(activeId) {
    const buttons = document.querySelectorAll('.button');
    buttons.forEach(button => {
        if (button.onclick.toString().includes(activeId)) {
            button.classList.add('active');
        } else {
            button.classList.remove('active');
        }
    });
}



//lounges
async function addLounges(id, text) {
    var url = URL_TEMPLATE + "select_to_lounges.html";
    const tableData = await consultDataUrl("/tables-list-data", { 'id': id });

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

function dataInputLounge(url, option) {


    const data = {
        name: document.getElementsByName('nameLounge')[0]?.value || '',
        address: document.getElementsByName('addressLounge')[0]?.value || '',
        code: document.getElementsByName('codeLounge')[0]?.value || '',
        floor: document.getElementsByName('floorLounge')[0]?.value || '',
        id: document.getElementsByName('idLounge')[0]?.value || 0,
        token: document.querySelector('input[name="_token"]').value
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': data.token
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(result => alert(result, option, data, 'lounge'), addLounges(null))
        .catch(error => console.error('Error:', error));

}
//table


async function addTable(id, code = null) {
    var url = URL_TEMPLATE + "select_to_table.html";

    fetch(url)
        .then(response => response.text())
        .then(template => {
            // Reemplaza los datos dinámicos en la plantilla principal
            let htmlContent = template
                .replaceAll('{{lounge}}', NAME_SELECT)
                .replaceAll('{{table}}', code);

            // Plantilla para cada item
            let itemTemplate = `
                <div class="item-detail-client">
                    <div class="item-details">
                        <span>INCA KOLA</span>
                        <span class="label-able">1L</span>
                        <p class="p-sub-text">1 Unidad(es) en S/ 6.50 | Unidad</p>
                    </div>
                    <div class="price-detail">S/ 6.50</div>
                </div>
            `;

            // Genera 30 items dinámicamente y los agrega al contenedor
            let itemsContent = '';
            for (let i = 0; i < 30; i++) {
                itemsContent += itemTemplate;
            }

            // Inserta el contenido generado de items en la plantilla principal
            htmlContent = htmlContent.replace('<div id="data-item-client">', `<div id="data-item-client">${itemsContent}`);

            const referenceElement = document.getElementById('puntoClave');
            referenceElement.innerHTML = ''; // Limpia el contenido actual
            referenceElement.innerHTML = htmlContent; // Inserta el nuevo contenido
        })
        .catch(error => console.error('Error loading template:', error));
}




$('.tables-list').on('click', function(event) {
    const target = $(event.target).closest('.table-item.table-data');
    const codeElement = target.find('.span-data-table');

    if (target.length && codeElement.length) {
        const tableId = target.data('id');
        const codeData = codeElement.text();
        const statusElement = target.find('#status');
        const dataIdValue = statusElement.data('id');

        console.log('Id: ' + tableId + '\nCode: ' + codeData + '\nEstado de Mesa: ' + dataIdValue);
        if(dataIdValue == 0){
            addTable(tableId, codeData);
        }if(dataIdValue == 1){

        }
    }
});


async function optionTablePlus(){
    var url = URL_TEMPLATE + "option_plus.html";
    const htmlContent = await loadHtmlFromFile(url);
    Swal.fire({
        title: null,
        icon: null,
        html:htmlContent,
        showCloseButton: false,
        showCancelButton: false,
        focusConfirm: false,
        didOpen: () => {
            $('.swal2-actions').css('display', 'none');
            $('div:where(.swal2-container)').css('z-index', 2001);
            $('div:where(.swal2-container) div:where(.swal2-popup)').css('padding', '0px');
            $('div:where(.swal2-container) .swal2-html-container').css({
                'padding': '1em',
                'display': 'flex'
            });
        }
      });
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
