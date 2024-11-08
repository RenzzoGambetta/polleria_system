
let searchBox = shortenRequest(apiUrl);
new SearchBox('No se encuntra la categoria...', '.search-category', '#search-category', '#search-label-category', '.suggestions-category', '#loader-category', '#id-category', '/list_of_category', 5, 0);

function handleRadioChange(event) {
    const selectedValue = event.target.value;

    if (selectedValue == 0) {
        $('#title').text('Nuevo plato o bebida');
        $('#sub-title').text('Conjunto que conforma un plato o bebida');
        $('#search-label').text('Suministro');
        searchBox = shortenRequest('/list_of_supplys');
        clearDivContents('.conteiner-etiker');
        clearDivContents('.hidden-inputs-container');
    } else if (selectedValue == 1) {
        $('#title').text('Nuevo combo');
        $('#sub-title').text('Conjunto que conforma un combo');
        $('#search-label').text('Item');
        searchBox = shortenRequest('/list_of_item');
        clearDivContents('.conteiner-etiker');
        clearDivContents('.hidden-inputs-container');
    } else {
        console.log("no se pudo realizar la accion");
    }
}

function shortenRequest(url) {
    return new SearchBox('No se encuntro el Producto...', '.search-box', '#search', '#search-label', '.suggestions', '#loader', '#id-item', url, 5, 0);
}

function clearDivContents(selector) {
    const div = document.querySelector(selector);
    if (div) {
        div.innerHTML = '';
    }
}
