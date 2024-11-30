var NAME_SELECT = "";
const URL_TEMPLATE = "/resources/order/template/";

$('.tables-list-tomozo').on('click', function (event) {
    const target = $(event.target).closest('.table-item.table-data');
    if (!target.length) return;
    const tableId = target.data('id');
    const codeData = target.find('.span-data-table').text();
    const statusId = target.find('#status').data('id');
    const loungeName = $('#title').text();

    console.log(`Id: ${tableId}\nCode: ${codeData}\nEstado de Mesa: ${statusId}\nEstado de sala: ${loungeName}`);
    if (statusId == 1) {
        addTable(tableId, codeData);
    }
    if (statusId == 0) {
        //window.location.href = url + '?id=' + tableId + '&code=' + codeData + '&sale=' + NAME_SELECT;
    }
});

async function addTable(id, code = null) {
    var url = URL_TEMPLATE + "select_to_table_view.html";
    const tableDataList = await consultDataUrl("/list_order_details_table", {
        'id': id
    });

    fetch(url)
        .then(response => response.text())
        .then(template => {
            let htmlContent = template
                .replaceAll('{{ lounge }}', NAME_SELECT)
                .replaceAll('{{ total }}', calculateTotal(tableDataList))
                .replaceAll('{{ id }}', id)
                .replaceAll('{{ table }}', code);

            let itemsContent = '';
            tableDataList.forEach(item => {
                let optionProduct = item.is_delibery === 1 ? 'Delivery' : 'Mesa';
                let colorOptionProduct = item.is_delibery === 1 ? '#720000b3' : '#0030c2b3';
                itemsContent += `
                <div class="item-detail-client" id="item-${item.id}">
                    <div class="item-details">
                        <span>${item.name}</span>
                        <span class="label-able" style="background-color:${colorOptionProduct};">${optionProduct}</span>
                        <p class="p-sub-text list-text-quantity" id="text-info-data-${item.id}">${item.quantity} Unidad(es) en s/ ${item.price} </p>
                        <p class="p-sub-note">Nota: ${item.note ? item.note.length > 30 ? item.note.substring(0, 30) + "..." : item.note : "sin nota"}</p>
                    </div>
                    <div class="price-detail" id="sub-total-price-${item.id}">s/ ${item.total_price}</div>

                    <div class="hover-message-item">
                       <div class="option-item-selec-list-table">
                            <button class="button-edit-list-table" onclick="editItemList(${item.id})"><i class="fi fi-sr-pencil center-icon"></i></button>
                            <button class="button-delate-list-table" onclick="deleteItemList(${item.id})"><i class="fi fi-sr-trash center-icon"></i></button>
                        </div>
                    </div>
                </div>
        `;
            })

            htmlContent = htmlContent.replace('<div id="data-item-client">', `<div id="data-item-client">${itemsContent}`);

            Swal.fire({
                html: htmlContent,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Registrar",
                didOpen: (popup) => {
                    if (typeof urlPostDeleteStyle === 'function') {
                        urlPostDeleteStyle(popup);
                    }

                },
                preConfirm: () => {

                }
            }).then(async (result) => {
                if (result.isConfirmed && result.value) {

                } else {

                }
            });

            $('.item-detail-client').hover(
                function () {
                    $(this).find('.hover-message-item').css({
                        opacity: 1,
                        visibility: 'visible',
                        backgroundColor: 'var(--color-item-selct-hover-product-table)'
                    });
                },
                function () {
                    $(this).find('.hover-message-item').css({
                        opacity: 0,
                        visibility: 'hidden'
                    });
                }
            );
        })

        .catch(error => console.error('Error loading template:', error));
}

function calculateTotal(selectedItems) {
    const total = selectedItems.reduce((sum, item) => {
        const itemTotal = item.quantity * parseFloat(item.price.replace('S/.', '').trim());
        return sum + itemTotal;
    }, 0);

    return total;
}
