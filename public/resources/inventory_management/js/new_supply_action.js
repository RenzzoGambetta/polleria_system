$(document).ready(function () {
    $('#checkbox-preference-input').change(function () {
        updateLabelColor();
    });
});

selectorItenandAnimation('selected-unit-of-measurement-supply-new', 'options-unit-of-measurement-supply-new', 'option-unit-of-measurement-supply-new', 'sub-title-div', OptionId);


$(function () {
    var savedValue = ''; // Variable para guardar el valor del input

    $('#switch-data').change(function () {
        var $stockData = $('#stock-data');

        if (this.checked) {
            $stockData.prop('disabled', false)
                .css({
                    'background-color': '',
                    'border': ''
                })
                .val(savedValue);
        } else {
            savedValue = $stockData.val();
            $stockData.prop('disabled', true)
                .css({
                    'background-color': 'var(--color-input-background-border)',
                    'border': 'var(--color-input-background-border)'
                }).
                val(null);
        }
    }).change();
});


let listo = false;
$('input').on('input change', function () {
    const nombre = $('input[name="name"]').val().trim();
    const sistema = $('input[name="unit"]:checked').val();
    if (nombre && sistema && !listo) {
        $('.register-or-edit').css('display', 'block');
        $('.cancel-btn').css({
            'border-top-right-radius': '0vh',
            'border-bottom-right-radius': '0vh'
        });
        listo = true;
    } else if (!nombre) {
        $('.register-or-edit').css('display', 'none');
        $('.cancel-btn').css({
            'border-top-right-radius': '2vh',
            'border-bottom-right-radius': '2vh'
        });
        listo = false;
    }
});

function exit() {
    history.back();
}

$(document).ready(function () {
    $('#stock-data').on('input', function () {
        var value = parseFloat($(this).val());

        if (value < 0) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "¡No se permiten números negativos!",
                didOpen: urlPostDeleteStyle
            });
            $(this).val(0);
        }
    });
});

$(document).ready(function () {
    const $dropFrame = $('#drop-frame');
    const $overlay = $('#overlay');
    const $fileInput = $('#file');

    let draggingImage = false;
    let dragLeaveTimeout;

    $('body').on('dragenter dragover dragleave drop', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    $('body').on('dragenter dragover', function (e) {

        if (!draggingImage) {
            draggingImage = true;
            $('#text-image').text('Suelta aca la imagen o elige una opcion');
        }
    });

    $('body').on('dragleave', function () {
        if (dragLeaveTimeout) {
            clearTimeout(dragLeaveTimeout);
        }

        dragLeaveTimeout = setTimeout(function () {
            if (draggingImage) {
                draggingImage = false;
                $('#text-image').text('Subir una imagen');
            }
        }, 5000);

    });

    $dropFrame.on('drop', function (e) {
        draggingImage = false;
        const files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            $fileInput[0].files = files;
            previewImage({ target: $fileInput[0] });
        }

    });
});


function showImages() {

    $.get('/get_image_gallery', function (images) {
        if (images.length > 0) {
            // Crear un HTML con las imágenes y sus nombres
            let content = `
            <div class="container-option-select">
                <div class="tabs">
                    <input type="radio" id="radio-1" name="tabs" checked="">
                    <label class="tab" for="radio-1">Suministros <i class="fi fi-sr-dolly-flatbed-alt icon-image-section"></i></label>
                    <input type="radio" id="radio-2" name="tabs">
                    <label class="tab" for="radio-2">Items <i class="fi fi-sr-plate-wheat icon-image-section"></i></label>
                    <input type="radio" id="radio-3" name="tabs">
                    <label class="tab" for="radio-3">Combos <i class="fi fi-sr-crown icon-image-section"></i></label>
                    <span class="glider"></span>
                </div>
            </div>
            
            <div class="image-container-primary">
            <div class="image-container-option-select">
            `;
            images.forEach(function (image) {
                let imageUrl = '/warehouse/supply/' + image;
                content += `
                    <div style="margin: 10px; text-align: center;color:var(--dark);">
                        <img src="${imageUrl}" alt="${image}" style="width: 100px; height: 100px; object-fit: cover;">
                        <p style="dsplay:none;">${image}</p>
                    </div>
                `;
            });
            content += '</div></div>';

            // Mostrar las imágenes en un SweetAlert2
            Swal.fire({
                title: 'Imágenes almacenadas',
                html: content,
                showCloseButton: true,
                didOpen: () => {

                    $('.swal2-popup.swal2-modal').css({
                        'height': '80vh',
                        'width': '90%',
                        'border-radius': '20px'
                    });
                    $('div:where(.swal2-container) .swal2-html-container').css({
                        'height': '60vh',
                    });
                    $('div:where(.swal2-container) h2:where(.swal2-title)').css({
                        'font-size': '1.5rem',
                        'padding-top': '15px',
                        'color': 'var(--dark)',
                    });

                    
                },
            });
        } else {
            Swal.fire('No hay imágenes', 'No se encontraron imágenes en la carpeta.', 'warning');
        }
    });
}