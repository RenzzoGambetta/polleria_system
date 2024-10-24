
function addLabel(idItem, supplyName, cantidad) {

    if (idItem && supplyName && cantidad) {
        const nuevaEtiqueta = $('<span>', { class: 'etiqueta-combo', text: `${supplyName}: ${cantidad}` });


        const inputIdHidden = $('<input>', { type: 'hidden', name: 'id_item_compact[]', value: idItem });
        const inputNombreHidden = $('<input>', { type: 'hidden', name: 'name_item_compact[]', value: supplyName });
        const inputCantidadHidden = $('<input>', { type: 'hidden', name: 'quantity_item_compact[]', value: cantidad });

        nuevaEtiqueta.on('click', function() {
            $('#id-item').val(inputIdHidden.val());
            $('#search').val(inputNombreHidden.val());
            $('#quantity').val(inputCantidadHidden.val());

            nuevaEtiqueta.remove();
            inputIdHidden.remove();
            inputNombreHidden.remove();
            inputCantidadHidden.remove();
        });

        const botonEliminar = $('<button>', { class: 'eliminar-etiqueta', text: 'x' });

        botonEliminar.on('click', function(event) {
            event.stopPropagation();
            nuevaEtiqueta.remove();
            inputIdHidden.remove();
            inputNombreHidden.remove();
            inputCantidadHidden.remove();
        });

        nuevaEtiqueta.append(botonEliminar);

        $('.conteiner-etiker').append(nuevaEtiqueta);
        $('.hidden-inputs-container').append(inputIdHidden, inputNombreHidden, inputCantidadHidden);

        limpiarCampos();
    } else {
        console.log('Por favor, completa todos los campos antes de agregar el combo.');
    }
}

function addItemInput(){
    const idItem = $('#id-item').val();
    const supplyName = $('#search').val();
    const cantidad = $('#quantity').val();

    addLabel(idItem, supplyName, cantidad)
}

function limpiarCampos() {
    $('#id-item, #search, #quantity').val('');
}

$('#add-combo').on('click', function(event) {
    event.preventDefault();
    addItemInput();
});




$(document).ready(async function() {
    if (id !== null) {

        const data = await consultDataUrl("/filt_item_data",{ 'id': id, 'combo': combo })
        data.forEach(item => {
            addLabel(item.id,item.name,item.quantity);
        });
    }
});


