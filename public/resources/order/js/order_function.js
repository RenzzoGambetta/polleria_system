const URL_TEMPLATE = "/resources/order/template/";
async function loadTableDataItem(id, text = null) {
    const tablesList = document.getElementById('tables-list');
    const tableData = await consultDataUrl("/list_item_filt_category", { 'id': id });
    var url = URL_TEMPLATE + "item_frame.html";

    tablesList.querySelectorAll('.table-item.table-data').forEach(element => element.remove());

    tablesList.innerHTML = '';
    tableData.forEach(data => {
        fetch(url)
            .then(response => response.text())
            .then(template => {
                let htmlContent = template
                    .replaceAll('{{id}}', data.id)
                    .replace('{{name}}', data.name)
                    .replaceAll('{{display_order}}', data.display_order)
                    .replace('{{price}}', data.price)
                    .replace('{{image}}', "https://chewinghappiness.com/wp-content/uploads/elementor/thumbs/Pollo-a-la-braza-1-1-q8niykr5rij1m5l9rmbufgj2tsi010f6hp22hmt3xs.jpg");

                tablesList.insertAdjacentHTML('beforeend', htmlContent);
            })
            .catch(error => console.error('Error loading template:', error));
    });



}