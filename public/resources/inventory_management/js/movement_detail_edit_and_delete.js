const URL_TEMPLATE = "/resources/inventory_management/template/";

async function editSupplyData(Data){
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

    }).then(async (result) => {
        if (result.isConfirmed) {

            //const supply = document.querySelector('input[name="supply"]:checked');
            const supplier = document.querySelector('input[name="supplier_id"]');
            //const supplyId = supply ? supply.value : null;
            const supplierId = supplier ? supplier.value : null;
            //const supplyName = supply ? supply.nextElementSibling.textContent : null;

            const supplyName = document.getElementsByName('supply_name')[0]?.value || null;
            const supplyId = parseInt(document.getElementsByName('id_supply_name')[0]?.value) || null;
            const price = parseFloat(document.getElementById('price-data').value) || 0;
            const quantity = parseFloat(document.getElementById('quantity-data').value) || 1;
            const save_option = document.getElementById('checkbox-preference-input').checked;

            const item = {
                name: supplyName,
                price_per_unit: price,
                quantity: quantity,
                supply: supplyId,
                supplier: supplierId,
            };
            if (save_option & supplyId != null) {
                //var rpta = anchorsupply(supplyId, supplierId);
                var anchorPostResult = await consultDataPost('/anchor_supply_provider', { supplyId: supplyId, supplierId: supplierId })
                // console.log(anchorPostResult);
                anchorPostResult.anchor = true;
                anchorPostResult.repeat = $(`#copntainer-${supplierId}-${supplyId}`).length > 0;

                console.log(anchorPostResult);
            } else {
                var anchorPostResult = {
                    repeat: $(`#copntainer-${supplierId}-${supplyId}`).length > 0,
                    achor: false,
                }
            }

            if (supplyId != null) {
                //for (let index = 0; index < 20; index++) {
                //    console.log('Prueva numero:'+index)
                addTableBodyAboveReference(item, anchorPostResult);

                //}
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
    supplyData = new SearchBox('No se encuntro el producto...', '.search-box', '#search', '#search-label', '.suggestions', '#loader', '#id-supply', apiUrl, 5, 0);
    //console.log(supplyData.idSelect());
    //fetchRoles();
    //selectorIten(".selected-iten", ".options-iten", ".option-iten");
    revertStyleDefaultAlert();
    $(document).ready(function () {
        $('#checkbox-preference-input').change(function () {
            updateLabelColor();
        });
    });
}