const URL_TEMPLATE = "/resources/menu_management/template/";
var ID_SELECT = 0;
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

async function loadTableData(id, option = null) {
    const tablesList = document.getElementById('tables-list');
    const addTableItem = document.getElementById('add-table-item');
    const tableData = await consultDataUrl("/tables-list-data", { 'id': id });
    var url = URL_TEMPLATE + "frame_table.html";

    tablesList.querySelectorAll('.table-item.table-data').forEach(element => element.remove());


    tableData.forEach(data => {
        fetch(url)
            .then(response => response.text())
            .then(template => {
                let htmlContent = template
                    .replaceAll('{{code}}', data.name)
                    .replaceAll('{{id}}', data.id);

                tablesList.insertAdjacentHTML('beforeend', htmlContent);
            })
            .catch(error => console.error('Error loading template:', error));
    });

    tablesList.prepend(addTableItem);

    highlightButton(id);
    if (option == 1) {
        addTable(null)
    } else {
        addLounges(id);
        $('.conteiner-table').show();
    }
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

function addButton(loungeId, loungeName) {
    const newButton = document.createElement('button');
    newButton.className = 'button';
    newButton.id = 'button_' + loungeId;
    newButton.onclick = function () { loadTableData(loungeId); };
    newButton.textContent = loungeName;

    const tabsContainer = document.getElementById('tabs-container');
    tabsContainer.appendChild(newButton);
}

//lounges
async function addLounges(id) {
    var url = URL_TEMPLATE + "edit_and_register_lounges.html";
    let result, data;

    if (id != null) {
        result = await consultDataUrl("/lounge_data_edit", { 'id': id });
        data = {
            title: 'Editar',
            button: 'Editar',
            classButton: 'edit',
            classButtonClear: 'clear'
        };
    } else {
        result = {
            id: '0',
            name: '',
            address: '',
            floor: '',
            code: ''
        };
        data = {
            title: 'Registrar',
            button: 'Agregar',
            classButton: 'new',
            classButtonClear: 'none'
        };
    }

    fetch(url)
        .then(response => response.text())
        .then(template => {
            let htmlContent = template
                .replaceAll('{{title}}', data.title)
                .replaceAll('{{button}}', data.button)
                .replaceAll('{{classButton}}', data.classButton)
                .replaceAll('{{classButtonClear}}', data.classButtonClear)
                .replaceAll('{{id}}', result.id)
                .replaceAll('{{name}}', result.name)
                .replaceAll('{{address}}', result.address)
                .replaceAll('{{floor}}', result.floor)
                .replaceAll('{{code}}', result.code);

            const referenceElement = document.getElementById('puntoClave');
            referenceElement.innerHTML = ''; // Limpia el contenido existente
            referenceElement.innerHTML = htmlContent; // Inserta el nuevo contenido
            ID_SELECT = id;
        })
        .catch(error => console.error('Error loading template:', error));
        $('.conteiner-table').show();

}
function newLoungeAction() {
    dataInputLounge('/new_lounge', 3);
}

function editLoungeAction() {
    dataInputLounge('/edit_lounge', 2);
}

function clearLoungeAction() {
    Swal.fire({
        title: "Estas seguro",
        text: "Se eliminara todas las mesas que cantiene la sala",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            dataInputLounge('/delate_lounge', 1);
        }
    });


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


function alert(result, option, data, action) {
    if (result.result) {
        Swal.fire({
            title: "Listo..",
            text: "Accion exitosa",
            icon: "success"
        }).then((res) => {
            if (res.isConfirmed) {
                if (action == 'lounge') {
                    if (option == 3) {
                        const tabsContainer = document.getElementById('tabs-container');
                        scrollInterval = setInterval(() => {
                            tabsContainer.scrollLeft += 10 * 500;
                        }, 10);
                    }
                }
            }
        });
        if (action == 'table') {
            if (option == 1) {
                deleteTableItemById(data.id)
            } else if (option == 3) {
                loadTableData(ID_SELECT, 1)
            } else if (option == 2) {
                $('#spma_' + data.id).text(data.code);
            }
        } else if (action == 'lounge') {
            if (option == 3) {
                addButton(result.id, data.name);
                loadTableData(result.id);
                $('#button_' + result.id).css('background-color', '#6b00b3');
            } else if (option == 2) {
                $('#button_' + data.id).text(data.name);
            } else if (option == 1) {
                deleteLoungeItemById(data.id);
                $('.conteiner-table').hide();

            }
        }
    } else {
        Swal.fire({
            title: "Opps..",
            text: "Tuvimos un error",
            icon: "error"
        });
    }
}
//table

document.getElementById('add-table-item').addEventListener('click', function () {
    addTable(null)
});

async function addTable(id, code = null) {
    var url = URL_TEMPLATE + "edit_and_register_table.html";
    let result, data;

    if (id != null) {
        result = {
            id: id,
            code: code
        };
        data = {
            title: 'Editar',
            button: 'Editar',
            classButton: 'edit',
            classButtonClear: 'clear'
        };
    } else {
        result = {
            id: '0',
            code: ''
        };
        data = {
            title: 'Registrar nueva',
            button: 'Agregar',
            classButton: 'new',
            classButtonClear: 'none'
        };
    }

    fetch(url)
        .then(response => response.text())
        .then(template => {
            let htmlContent = template
                .replaceAll('{{title}}', data.title)
                .replaceAll('{{button}}', data.button)
                .replaceAll('{{classButton}}', data.classButton)
                .replaceAll('{{classButtonClear}}', data.classButtonClear)
                .replaceAll('{{id}}', result.id)
                .replaceAll('{{code}}', result.code);


            const referenceElement = document.getElementById('puntoClave');
            referenceElement.innerHTML = '';
            referenceElement.innerHTML = htmlContent;
        })
        .catch(error => console.error('Error loading template:', error));
}
function newTableAction() {
    dataInputTable('/new_table', 3);
}

function editTableAction() {
    dataInputTable('/edit_table', 2);
}

function clearTableAction() {
    dataInputTable('/delate_table', 1);

}

document.getElementById('tables-list').addEventListener('click', function (event) {

    const target = event.target.closest('.table-item.table-data');
    const codeElement = target ? target.querySelector('.span-data-table') : null;

    if (target && codeElement) {
        const tableId = target.getAttribute('data-id');
        const codeData = codeElement.textContent;
        addTable(tableId, codeData)

    }
});
function dataInputTable(url, option) {

    if(ID_SELECT != null){
        const data = {
            code: document.getElementsByName('codeTable')[0]?.value || '',
            id: document.getElementsByName('idTable')[0]?.value || 0,
            lounge_id: ID_SELECT,
            token: document.querySelector('input[name="_token"]').value
        };
        //console.log(data);
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': data.token
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(result => alert(result, option, data, 'table'), addTable(null))
            .catch(error => console.error('Error:', error));
    }else{
        Swal.fire({
            title: "Opps..",
            text: "Seleccione una sala o cree una",
            icon: "error"
        });
    }
}


function deleteTableItemById(id) {

    const itemToDelete = document.querySelector(`.table-item.table-data[data-id="${id}"]`);
    if (itemToDelete) {
        itemToDelete.remove(); // Eliminar el elemento del DOM
        console.log(`Mesa con id ${id} eliminada.`); // Mensaje de confirmación
    } else {
        console.log(`No se encontró mesa con id ${id}.`); // Mensaje de error si no se encuentra
    }

}
function deleteLoungeItemById(id) {

    const itemToDelete = document.querySelector(`.button[id="button_${id}"]`);
    if (itemToDelete) {
        itemToDelete.remove(); // Eliminar el elemento del DOM
        console.log(`Mesa con id ${id} eliminada.`); // Mensaje de confirmación
    } else {
        console.log(`No se encontró mesa con id ${id}.`); // Mensaje de error si no se encuentra
    }

}
