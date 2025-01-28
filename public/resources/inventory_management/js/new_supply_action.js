let storedImages = [];
const templateUrl = '/resources/config/template';
let nameFileGallery = 'supply';

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

//*
// Inplementacion de arrastre y sulte en todo el body 
// */ 
$(document).ready(function () {
    const $overlay = $("#overlay");
    const $dropzoneArea = $("#dropzone-area");
    const csrfToken = $('input[name="_token"]').val();
    const allowedFileTypes = ["image/jpeg", "image/png", "image/jpg", "image/gif"];

    if (!$overlay.length || !$dropzoneArea.length || !csrfToken) {
        console.error("Faltan elementos necesarios ($overlay, $dropzoneArea o CSRF token).");
        return;
    }

    // Mostrar el overlay y el área de dropzone al arrastrar archivos
    $(window).on("dragenter", function (event) {
        if (event.originalEvent.dataTransfer?.types.includes("Files")) {
            $overlay.show();
            $dropzoneArea.css("display", "flex");
        }
    });

    // Ocultar el overlay cuando el ratón sale del área de dropzone
    $overlay.on("dragleave", function (event) {
        if (event.target === $overlay[0]) {
            $overlay.hide();
            $dropzoneArea.hide();
        }
    });

    // Evitar el comportamiento por defecto y mantener el overlay visible
    $overlay.on("dragover", function (event) {
        event.preventDefault();
    });

    // Manejar el evento de soltar archivos
    $overlay.on("drop", function (event) {
        event.preventDefault();
        $overlay.hide();
        $dropzoneArea.hide();

        const files = event.originalEvent.dataTransfer.files;

        if (files.length > 0) {
            const file = files[0]; // Tomar solo el primer archivo

            // Validar el tipo de archivo
            if (!allowedFileTypes.includes(file.type)) {
                Swal.fire({
                    icon: "info",
                    title: "Archivo no permitido",
                    text: "Este archivo no es válido. Solo se permiten imágenes en formato JPG, JPEG, PNG o GIF.",
                    confirmButtonText: "Entendido",
                });
                return;
            }

            // Utilizar la función previewImage
            const eventMock = { target: { files: [file] } };
            previewImage(eventMock); // Llamar a la función de vista previa
        }
    });
});

/**fin */
async function fetchImages() {
    try {
        const response = await fetch(`/get_image_gallery?name_file=${nameFileGallery}`);
        if (!response.ok) {
            throw new Error('Error al obtener las imágenes');
        }
        const images = await response.json();
        storedImages = images;
    } catch (error) {
        console.error('Error al obtener las imágenes:', error);
    }
}

async function showImages() {

    await fetchImages();
    const template = await loadHtmlFromFile(templateUrl + '/image_template.html');
    if (!template) return;

    let content = `
       <div class="container-option-select">
            <div class="tabs">
                <input type="radio" id="radio-1" name="tabs" value="supply" checked="">
                <label class="tab" for="radio-1">Suministros <i class="fi fi-sr-dolly-flatbed-alt icon-image-section"></i></label>
                <input type="radio" id="radio-2" name="tabs" value="item">
                <label class="tab" for="radio-2">Items <i class="fi fi-sr-plate-wheat icon-image-section"></i></label>
                <input type="radio" id="radio-3" name="tabs" value="combo">
                <label class="tab" for="radio-3">Combos <i class="fi fi-sr-crown icon-image-section"></i></label>
                <span class="glider"></span>
            </div>
        </div>
        
        <div class="image-container-primary">
            <div class="image-container-option-select">
                <div class="container-image-frame-panel-select" onclick="clearPreviewImage()" style="display: flex;justify-content: center;align-items: center;border: 3px dotted var(--dark);var(--dark: );border-radius: 10px;">
                    <p style="color: black;">Quitar Imagen</p>
                </div>
    `;
    storedImages.forEach(function (image) {
        const imageUrl = `/warehouse/${nameFileGallery}/${image}`;

        const imageHtml = template
            .replaceAll('{{imageUrl}}', imageUrl)
            .replaceAll('{{imageName}}', procesarNombreArchivo(image));

        content += imageHtml;
    });
  content += '</div></div>';

    // Mostrar las imágenes en un SweetAlert2
    Swal.fire({
        title: 'Imágenes almacenadas',
        html: content,
        showConfirmButton: false,
        showCloseButton: true,
        didOpen: () => {

            $('.swal2-popup.swal2-modal').css({
                'height': '80vh',
                'width': '90%',
                'border-radius': '20px'
            });
            $('div:where(.swal2-container) .swal2-html-container').css({
                'height': '70vh',
            });
            $('div:where(.swal2-container) h2:where(.swal2-title)').css({
                'font-size': '1.5rem',
                'padding-top': '15px',
                'color': 'var(--dark)',
            });

            $(document).ready( function() {
                $('input[name="tabs"]').on('change',async function() {
                    var selectedValue = $(this).val();
                    console.log(selectedValue);
                    nameFileGallery = selectedValue;
                    $(".image-container-option-select").slideUp(400);
                    await showImagesAlertUpdate();
                    $(".image-container-option-select").slideDown(800);
            
                });
            });
            

        },
    });
}
function procesarNombreArchivo(nombreArchivo) {

    let nombreSinNumeros = nombreArchivo.split('_').slice(1).join('_');

    let nombrePuro = nombreSinNumeros.split('.')[0];

    if (nombrePuro.length > 10) {
        nombrePuro = nombrePuro.substring(0, 25) + '...';
    }

    return nombrePuro;
}


async function showImagesAlertUpdate() {
    await fetchImages();
    const template = await loadHtmlFromFile(templateUrl + '/image_template.html');
    if (!template) return;

    let content = ` 
                <div class="container-image-frame-panel-select"clearPreviewImage()" style="display: flex;justify-content: center;align-items: center;border: 3px dotted var(--dark);var(--dark: );border-radius: 10px;">
                    <p style="color: black;">Quitar Imagen</p>
                </div>`;
    storedImages.forEach(function (image) {
        const imageUrl = `/warehouse/${nameFileGallery}/${image}`;

        const imageHtml = template
            .replaceAll('{{imageUrl}}', imageUrl)
            .replaceAll('{{imageName}}', procesarNombreArchivo(image));

        content += imageHtml;
    });

    const container = document.querySelector('.image-container-option-select');
    if (container) {
        container.innerHTML = content;
    }
}
function clearPreviewImage(){
    const existingImg = document.getElementById('preview-image');
    const iconPreview = document.getElementById('icon-preview');
    const textPreview = document.getElementById('text-preview');

    if (existingImg) {
        existingImg.remove(); 
    }
    iconPreview.style.display = 'flex'; 
    textPreview.style.display = 'flex'; 
    
    fileDataGlobal = null;
    Swal.close();
}
function mostrarAlerta(urlImage, nameImage){
    fileDataGlobal = null;
    urlNameGloval = urlImage;
    
    const existingImg = document.getElementById('preview-image');
    const iconPreview = document.getElementById('icon-preview');
    const textPreview = document.getElementById('text-preview');

    if (existingImg) {  
        existingImg.src = urlImage;
        Swal.close();
    } else {
     
        const imgPreview = document.createElement('img');
        imgPreview.src = urlImage;
        imgPreview.id = 'preview-image';
        imgPreview.className = 'Img-style-preview';

        iconPreview.style.display = 'none';
        textPreview.style.display = 'none';

        iconPreview.parentNode.insertBefore(imgPreview, iconPreview);
        Swal.close();
    }
}

document.getElementById('myForm').addEventListener('submit', async function (event) {
    event.preventDefault(); // Evitar el envío predeterminado
    console.log('Se ingresó al submit');

    // Obtener el token CSRF
    const csrfToken = document.querySelector('input[name="_token"]')?.value;
    if (!csrfToken) {
        Swal.fire({
            title: "Error!",
            text: "Token CSRF no encontrado.",
            icon: "error",
            confirmButtonText: "Entendido"
        });
        return;
    }

    // Verificar si hay una imagen seleccionada
    if (fileDataGlobal) {
        const formData = new FormData();
        formData.append("image", fileDataGlobal);
        formData.append("image_name", cleanFileName(document.getElementById('name-data').value));
        formData.append("folder_name", 'supply');

        try {
            const response = await fetch("/new_image_galery", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                body: formData
            });

            if (!response.ok) {
                throw new Error("Error al subir la imagen.");
            }

            const data = await response.json();

            if (data.success && data.new_url) {
                document.getElementById('imageURL').value = data.new_url;
                document.getElementById('myForm').submit();
            } else {
                await Swal.fire({
                    title: "Error!",
                    text: data.message || "No se pudo procesar la imagen.",
                    icon: "error",
                    confirmButtonText: "Entendido"
                });
                document.getElementById('myForm').submit();
            }

        } catch (error) {
            Swal.fire({
                title: "Error!",
                text: error.message || "No se pudo subir la imagen.",
                icon: "error",
                confirmButtonText: "Entendido"
            });
        }

        await fetchImages(); // Esperar la carga de imágenes

    } else if (urlNameGloval) {
        document.getElementById('imageURL').value = urlNameGloval;
        document.getElementById('myForm').submit();
        await fetchImages();

    } else {
        await fetchImages();
        document.getElementById('myForm').submit();
    }
});

function cleanFileName(fileName) {
    // Reemplaza los caracteres no permitidos con un guion bajo (_) en Windows
    return fileName.replace(/[\\\/:*?"<>|]/g, '_'); // Reemplaza caracteres no permitidos por guiones bajos
}
$(document).ready(function () {
    $('#code-data').on('input', function () {
        // Permitir solo números (incluyendo ceros)
        let value = $(this).val().replace(/[^0-9]/g, '');

        $(this).val(value);
    });

    // Evitar que se peguen caracteres no permitidos
    $('#code-data').on('paste', function (event) {
        event.preventDefault();
        let pasteData = (event.originalEvent || event).clipboardData.getData('text');
        let cleanedData = pasteData.replace(/[^0-9]/g, ''); // Permite solo números
        $(this).val(cleanedData);
    });

    // Evitar que se use el signo "-" o "e" con el teclado
    $('#code-data').on('keydown', function (event) {
        if (event.key === '-' || event.key === 'e') {
            event.preventDefault();
        }
    });
});
