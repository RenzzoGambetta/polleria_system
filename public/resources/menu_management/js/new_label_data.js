let dataLabel = [];

function addLabel(idItem, supplyName, cantidad) {
    if (idItem && supplyName && cantidad) {
        // Verificar si el idItem ya existe en dataLabel
        let existingLabel = dataLabel.find(item => item.idItem === idItem);

        if (existingLabel) {
            // Si ya existe, sumar la cantidad y actualizar la etiqueta y el input
            existingLabel.cantidad += parseInt(cantidad);
            $(`#label_${idItem}`).text(`${supplyName}: ${existingLabel.cantidad}`);
            $(`input[name="quantity_item_compact[]"][value="${existingLabel.cantidad - cantidad}"]`).val(existingLabel.cantidad);
            $(`#label_${idItem}`).append(`<button class="eliminar-etiqueta" onclick="deleteEditedSpam(${idItem})">x</button>`);

        } else {
            // Si no existe, agregar un nuevo registro en dataLabel
            dataLabel.push({ idItem, supplyName, cantidad: parseInt(cantidad) });

            // Crear elementos de la etiqueta y los inputs
            const nuevaEtiqueta = $('<span>', { 
                class: 'etiqueta-combo', 
                text: `${supplyName}: ${cantidad}`, 
                id: `label_${idItem}`
            });

            const inputIdHidden = $('<input>', { type: 'hidden', name: 'id_item_compact[]', value: idItem ,id: `input_id_${idItem}`});
            const inputNombreHidden = $('<input>', { type: 'hidden', name: 'name_item_compact[]', value: supplyName ,id: `input_name_${idItem}`});
            const inputCantidadHidden = $('<input>', { type: 'hidden', name: 'quantity_item_compact[]', value: cantidad ,id: `input_quantity_${idItem}`});

            // Agregar comportamiento de edición al hacer clic en la etiqueta
            nuevaEtiqueta.on('click', function () {
                $('#id-item').val(inputIdHidden.val());
                $('#search').val(inputNombreHidden.val());
                $('#quantity').val(inputCantidadHidden.val());

                // Eliminar la etiqueta y los inputs asociados
                nuevaEtiqueta.remove();
                inputIdHidden.remove();
                inputNombreHidden.remove();
                inputCantidadHidden.remove();

                // También eliminar el registro de dataLabel
                dataLabel = dataLabel.filter(item => item.idItem !== idItem);
            });

            // Agregar funcionalidad al botón eliminar
            const botonEliminar = $('<button>', { class: 'eliminar-etiqueta', text: 'x' });

            botonEliminar.on('click', function (event) {
                event.stopPropagation();
                nuevaEtiqueta.remove();
                inputIdHidden.remove();
                inputNombreHidden.remove();
                inputCantidadHidden.remove();

                // También eliminar el registro de dataLabel
                dataLabel = dataLabel.filter(item => item.idItem !== idItem);
            });

            nuevaEtiqueta.append(botonEliminar);

            // Agregar la etiqueta y los inputs al DOM
            $('.conteiner-etiker').append(nuevaEtiqueta);
            $('.hidden-inputs-container').append(inputIdHidden, inputNombreHidden, inputCantidadHidden);
        }

        limpiarCampos();
    } else {
        console.log('Por favor, completa todos los campos antes de agregar el combo.');
    }
}

function deleteEditedSpam(id){
  
        $(`#input_id_${id}`).remove();
        $(`#input_name_${id}`).remove();
        $(`#input_quantity_${id}`).remove();
        $(`#label_${id}`).remove();

        dataLabel = dataLabel.filter(item => item.idItem !== id);
}
function addItemInput() {
    const idItem = $('#id-item').val();
    const supplyName = $('#search').val();
    const cantidad = $('#quantity').val();

    addLabel(idItem, supplyName, cantidad)
}

function limpiarCampos() {
    $('#id-item, #search, #quantity').val('');
}

$('#add-combo').on('click', function (event) {
    event.preventDefault();
    addItemInput();
});




$(document).ready(async function () {
    try {
        if (id !== null) {

            const data = await consultDataUrl("/filt_item_data", { 'id': id, 'combo': combo })
            data.forEach(item => {
                addLabel(item.id, item.name, item.quantity);
            });
        }
    } catch (e) {
        console.log('Es un nuevo producto..? o error:' + e)
    }
});


