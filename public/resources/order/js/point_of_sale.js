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
            let htmlContent = template
                .replaceAll('{{lounge}}', NAME_SELECT)
                .replaceAll('{{table}}', code);

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

            let itemsContent = '';
            for (let i = 0; i < 30; i++) {
                itemsContent += itemTemplate;
            }

            htmlContent = htmlContent.replace('<div id="data-item-client">', `<div id="data-item-client">${itemsContent}`);

            const referenceElement = document.getElementById('puntoClave');
            referenceElement.innerHTML = '';
            referenceElement.innerHTML = htmlContent;
        })
        .catch(error => console.error('Error loading template:', error));
}

async function newOrderForTheCounter(id, code = null) {
    var url = URL_TEMPLATE + "new_order_counter.html";

    fetch(url)
        .then(response => response.text())
        .then(template => {

            let htmlContent = template
                .replaceAll('{{lounge}}', NAME_SELECT)
                .replaceAll('{{table}}', code)
                .replaceAll('{{id}}', id);

            const referenceElement = document.getElementById('puntoClave');
            referenceElement.innerHTML = '';
            referenceElement.innerHTML = htmlContent;
            new SearchBox('No se encuntro el Producto...', '.search-box', '#search', '#search-label', '.suggestions', '#loader', '#id-waiter', '/assigned_waiter', 5, 0);
            new SearchBoxClient('No se encuntro el Cliente...', '.search-box-data-client', '#search-client', '#search-label-client', '.suggestions-client', '#id-waiter-client', '/client_data_filt', 5, 0);
        })
        .catch(error => console.error('Error loading template:', error));
}


$('.tables-list').on('click', function (event) {
    const target = $(event.target).closest('.table-item.table-data');
    const codeElement = target.find('.span-data-table');

    if (target.length && codeElement.length) {
        const tableId = target.data('id');
        const codeData = codeElement.text();
        const statusElement = target.find('#status');
        const dataIdValue = statusElement.data('id');

        //console.log('Id: ' + tableId + '\nCode: ' + codeData + '\nEstado de Mesa: ' + dataIdValue);
        if (dataIdValue == 1) {
            addTable(tableId, codeData);
        } if (dataIdValue == 0) {
            window.location.href = url;
        }
    }
});


async function optionTablePlus() {
    var url = URL_TEMPLATE + "option_plus.html";
    const htmlContent = await loadHtmlFromFile(url);
    Swal.fire({
        title: null,
        icon: null,
        html: htmlContent,
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

$('.counter-next').on('click', function () {
    var container = $('.option-to-refresh-and-nex-to-style-order');
    var navTable = $('.option-to-nav-table-container');
    var textButton = $('.counter-next');


    $(this).fadeOut(200, function () {
        if ($(this).hasClass('right')) {
            $(this).removeClass('right').addClass('left');
            textButton.html('Mostrador<i class="fi fi-br-angle-small-right"></i>');
            container.append($(this));
        } else {
            $(this).removeClass('left').addClass('right');
            textButton.html('<i class="fi fi-br-angle-small-left"></i>Mesas');
            container.prepend($(this));
        }
        $(this).fadeIn(200);
    });

    navTable.fadeOut(200, function () {

        if (navTable.css('flex-direction') === 'row') {
            navTable.css('flex-direction', 'row-reverse');
        } else {
            navTable.css('flex-direction', 'row');
        }

        navTable.fadeIn(200);
    });
});
 
function newOrderToClient(id){

    const nameOfInput = ["number_people", "id_user", "user_name", "id_person", "document_and_name_to_person"];
    const valueOfInput = {};
    nameOfInput.forEach(name => {
        valueOfInput[name] = $(`input[name="${name}"]`).val();
    });

    if(valueOfInput.number_people == null){
        console.log("nulo");
    }
    if(valueOfInput.id_user != null){
        console.log(valueOfInput.user_name);
    }else{
        $('input[name="supply_name"]').css('border', '2px solid rgb(157, 22, 22)');
    }
    if(valueOfInput.id_person != null){
        console.log(valueOfInput.document_and_name_to_person);
    }
}