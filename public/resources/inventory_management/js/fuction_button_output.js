const URL_TEMPLATE = "/resources/inventory_management/template/";
const URL_TEMPLATE_ALERT = "/resources/order/template/";

let isAddingSupply = false; // Variable para controlar el estado de bloqueo

async function addSupply() {
    if (isAddingSupply) {
        console.log("Espere un momento antes de añadir otro suministro.");
        return; // Evita múltiples ejecuciones simultáneas
    }

    isAddingSupply = true; // Bloquea nuevas ejecuciones
    function generateUniqueNumber() {
        return Date.now() + Math.floor(Math.random() * 1000); // Marca de tiempo + número aleatorio
    }
    try {
        const supplyElement = document.getElementsByName('id_supply_name')[0];
        if (supplyElement) {
            const id = parseFloat(supplyElement.value) || 0;

            if (id !== 0) {
                var newTbody = document.createElement('tbody');
                var url = URL_TEMPLATE + "structured_row_template_output_table.html";
                var filter = document.querySelector('.filter');
                var table = document.querySelector('.content main .bottom-data .orders table');

                newTbody.classList.add('list-inten', 'iten');
                const data = {
                    id: id
                };

                const result = await querySearchGet("/query_supply_data", data);
               
                await fetch(url)
                    .then(response => response.text())
                    .then(template => {
                        let htmlContent = template
                            .replaceAll('{{id}}', generateUniqueNumber())
                            .replaceAll('{{id_supply}}', result.id)
                            .replace('{{name}}', result.name)
                            .replace('{{price}}', result.last_price)
                            .replace('{{quantity}}', 1)
                            .replace('{{unit}}', result.unit);

                        newTbody.innerHTML = htmlContent;

                        var referenceElement = document.getElementById('puntoClave');
                        referenceElement.parentNode.insertBefore(newTbody, referenceElement.previousSibling);
                    })
                    .catch(error => console.error('Error loading template:', error));

                filter.style.display = 'none';
                table.style.display = 'revert';
                document.getElementById('search').value = null;
                document.getElementById('id-supply').value = null;
            } else {
                console.log("Seleccione un producto. ID actual: " + id);
            }
        } else {
            console.log("No se encontró el elemento con el nombre 'id_supply_name'.");
        }
    } catch (error) {
        console.error("Error al añadir suministro:", error);
    } finally {
        // Desbloquea la ejecución después de 2 segundos
        setTimeout(() => {
            isAddingSupply = false;
        }, 1000);
    }
}

document.getElementById('form-register-output').addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
    }
});

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
    //   sumOfPrices();

}
function clearComentDataAlert() {
    $('#comment-input').val('');
}
async function noteDetailOrder(idInput) {
    try {
        const url = `${URL_TEMPLATE_ALERT}commentary_order_total.html`;
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
                // Asegúrate de que el input existe antes de asignar el valor
                const commentInput = $(popup).find('#comment-input');
                if (commentInput.length && $(idInput).length) {
                    commentInput.val($(idInput).val());
                }
            }, 
            preConfirm: () => {
                const noteValue = $('#comment-input').val();
                return {
                    note: noteValue,
                };
            }
            
        }).then((result) => {
            if (result.isConfirmed) {
                if ($(idInput).length) {
                    $(idInput).val(result.value.note);
                }
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                console.log("Acción cancelada");
            }
        });
    } catch (error) {
        console.error("Error en noteDetailOrder:", error);
    }
}
