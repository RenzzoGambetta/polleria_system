let storedImages = [];
const templateUrl = '/resources/config/template';
let imageUrlGlobal, imageNameGlobal;
let selectedFile = null;
let nameFileGallery = 'supply';

const imagesPerPage = 6;  // Número de imágenes por página
let currentPage = 1;      // Página actual

// Función para obtener las imágenes del servidor
async function fetchImages() {
    try {
        const response = await fetch(`/get_image_gallery?name_file=${nameFileGallery}`);
        if (!response.ok) {
            throw new Error('Error al obtener las imágenes');
        }
        const images = await response.json();
        storedImages = images;
        //console.log('Imágenes obtenidas:', storedImages);

        showImages();
    } catch (error) {
        console.error('Error al obtener las imágenes:', error);
    }
}

async function showImages() {
    const template = await loadHtmlFromFile(templateUrl + '/image_template.html');
    if (!template) return;

    let content = '';
    storedImages.forEach(function (image) {
        const imageUrl = `/warehouse/${nameFileGallery}/${image}`;

        const imageHtml = template
            .replaceAll('{{imageUrl}}', imageUrl)
            .replaceAll('{{imageName}}', procesarNombreArchivo(image));

        content += imageHtml;
    });

    // Inserta el contenido generado en el contenedor
    const container = document.querySelector('.image-container-option-select');
    if (container) {
        container.innerHTML = content;
    }
}
function procesarNombreArchivo(nombreArchivo) {

    let nombreSinNumeros = nombreArchivo.split('_').slice(1).join('_');

    let nombrePuro = nombreSinNumeros.split('.')[0];

    if (nombrePuro.length > 10) {
        nombrePuro = nombrePuro.substring(0, 25) + '...';
    }

    return nombrePuro;
}

async function mostrarAlerta(imageUrl, imageName, option = true) {
    if (option) {
        imageUrlGlobal = imageUrl;
        imageNameGlobal = imageNameGlobal;
    }

    Swal.fire({
        title: 'Imagen',
        html: `
        <img class="image-alert-pre-view" src="${imageUrl}" alt="${imageName}" />
        <p class="name-frame-data-select-alert">${imageName}</p>
        <input id="image-data-alert" type="file" accept="image/*" onchange="previewImageAlert(event)" style="display:none;" name="image">
        `,
        showCloseButton: true,
        showConfirmButton: false,
        footer: `
            <button id="btnDelete" class="swal2-confirm swal2-styled alert-button">Eliminar</button>
            <button id="btnUpdate" class="swal2-confirm swal2-styled alert-button">Actualizar</button>
            <button id="btnDownload" class="swal2-confirm swal2-styled alert-button">Descargar</button>
        `,
        didOpen: () => {
            $('button#btnDelete').css({
                'background': 'linear-gradient(to right, #b40000, #df0000, #ff0000)',
            });
            $('.swal2-container.swal2-center.swal2-backdrop-show').css('backdrop-filter', 'blur(5px)');
            $('button#btnUpdate').css({
                'background': 'linear-gradient(to right, rgb(0 36 180), rgb(0 101 223), rgb(0 124 255))',
            });
            $('button#btnDownload').css({
                'background': 'linear-gradient(to right, rgb(0 124 2), rgb(57 159 0), rgb(29 202 0))',
            });
            $('.swal2-confirm.swal2-styled.alert-button').css({
                'width': '30%',
            });
            $('.name-frame-data-select-alert').css({
                'text-align': 'center',
                'color': 'var(--dark)',
                'font-style': 'italic',
                'font-weight': '400',
            });
            $('.image-alert-pre-view').css({
                'max-width': '100%',
                'min-width': '80%',
                'margin-bottom': '15px',
                'border-radius': '5px',
                'border': '1px dashed #82828278',
                'max-height': '55vh',
                'object-fit': 'contain',
                '-webkit-user-drag': 'none',
            });
            $('.swal2-popup.swal2-modal').css({
                'max-height': '80vh',
                'max-width': '80%',
                'border-radius': '10px',
                'user-select': 'none',
            });

            $('div:where(.swal2-container) h2:where(.swal2-title)').css({
                'font-size': '1.5rem',
                'color': 'var(--dark)',
            });
            $('div:where(.swal2-container) div:where(.swal2-footer)').css({
                'border-top': '1px solid rgb(171 171 171 / 60%)',

            });

        },
        didRender: () => {

            document.getElementById('btnDelete').addEventListener('click', () => {
                Swal.fire({
                    title: '¿Estas seguro de eliminar?',
                    text: 'Esta accion es inreversible y se eliminara de forma permanente del sistema y afectara a los suministros que lo usan!!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    didOpen: urlPostDeleteStyle
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        let result = await consultDataPost('/delete_image_gallery', { image_url: imageUrl, name_file: nameFileGallery })
                        if (result.success) {
                            fetchImages();
                            Swal.close();
                        } else {
                            display.alert('No se pudo eliminar la imagen');
                        }
                    }
                });

            });
            document.getElementById('btnUpdate').addEventListener('click', () => {
                document.getElementById('image-data-alert').click();
            });
            document.getElementById('btnDownload').addEventListener('click', () => {
                const link = document.createElement('a');
                link.href = imageUrl;
                const fileName = imageUrl.split('/').pop();
                link.download = fileName;
                link.click();
            });

        },
    });
}

function previewImageAlert(event) {

    Swal.fire({
        title: 'Confirme la actualizacion',
        html: `
        <div class="image-comparison-alert">
            <img class="image-alert-pre-view" src="${imageUrlGlobal}" alt="${imageNameGlobal}" />
            <div class="icon-alert-comparison">
                <i class="fi fi-ss-right"></i>
            </div>
            <img class="image-alert-pre-view" id="image-alert-pre-view-update" src="" alt="" />
        </div>
        <input id="image-data-alert" type="file" accept="image/*" onchange="previewUpdateImageAlert(event)" style="display:none;" name="image">
        `,
        showCloseButton: true,
        showConfirmButton: false,
        footer: `
            <button id="btnCancel" class="swal2-confirm swal2-styled alert-button">Cancelar</button>
            <button id="btnUpdate" class="swal2-confirm swal2-styled alert-button">Actualizar</button>
        `,
        didOpen: () => {
            $('.image-comparison-alert').css({
                'display': 'flex',
                'justify-content': 'center',
                'align-items': 'center',
            });
            $('.swal2-container.swal2-center.swal2-backdrop-show').css('backdrop-filter', 'blur(5px)');
            $('.icon-alert-comparison').css({
                'font-size': '2rem',
                'color': 'var(--dark)',
                'padding': '20px',
            });
            $('button#btnCancel').css({
                'background': 'linear-gradient(to right, #b40000, #df0000, #ff0000)',
            });
            $('button#btnUpdate').css({
                'background': 'linear-gradient(to right, rgb(0 36 180), rgb(0 101 223), rgb(0 124 255))',
            });

            $('.swal2-confirm.swal2-styled.alert-button').css({
                'width': '45%',
            });
            $('.name-frame-data-select-alert').css({
                'text-align': 'center',
                'color': 'var(--dark)',
                'font-style': 'italic',
                'font-weight': '400',
            });
            $('.image-alert-pre-view').css({
                'max-width': '100%',
                'min-width': '40%',
                'margin-bottom': '15px',
                'border-radius': '5px',
                'border': '1px dashed #82828278',
                'max-height': '55vh',
                'object-fit': 'contain',
                '-webkit-user-drag': 'none',
            });
            $('.swal2-popup.swal2-modal').css({
                'max-height': '80vh',
                'max-width': '80%',
                'width': 'auto',
                'border-radius': '10px',
                'user-select': 'none',
            });

            $('div:where(.swal2-container) h2:where(.swal2-title)').css({
                'font-size': '1.5rem',
                'color': 'var(--dark)',
            });
            $('div:where(.swal2-container) div:where(.swal2-footer)').css({
                'border-top': '1px solid rgb(171 171 171 / 60%)',

            });

            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector('#image-alert-pre-view-update').src = e.target.result;
                };
                reader.readAsDataURL(file);
                selectedFile = file;
            }
        },
        didRender: () => {

            document.getElementById('btnCancel').addEventListener('click', () => {
                Swal.close();
            });
            document.getElementById('btnUpdate').addEventListener('click', () => {
                uploadImage()
            });

        },
    });

}
async function uploadImage() {
    if (!selectedFile) {
        Swal.fire('Advertencia', 'Por favor selecciona una imagen.', 'warning');
        return;
    }

    const formData = new FormData();
    formData.append("image", selectedFile);
    formData.append("current_url", imageUrlGlobal);

    let progressPercentage = 0;
    let timerInterval;

    Swal.fire({
        title: "Cargando imagen...",
        html: `
            <div>Cargando... <b>0%</b></div>
            <div class="progress-bar" style="width: 100%; background: #ccc; border-radius: 5px; overflow: hidden;">
                <div id="progress-bar-fill" style="width: 0%; height: 20px; background: #4caf50;"></div>
            </div>
        `,
        didOpen: () => {
            urlPostDeleteStyle();
            Swal.showLoading();
            const progressBarFill = document.getElementById('progress-bar-fill');
            const progressText = Swal.getHtmlContainer().querySelector('b');

            timerInterval = setInterval(() => {
                progressPercentage += 5; // Simula progreso
                progressBarFill.style.width = `${progressPercentage}%`;
                progressText.textContent = `${progressPercentage}%`;

                if (progressPercentage >= 100) {
                    clearInterval(timerInterval);
                }
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        },
        allowOutsideClick: false,
        showConfirmButton: false
    });

    try {
        const response = await fetch('/upload_image_gallery', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value // CSRF token
            },
            body: formData
        });

        if (!response.ok) {
            throw new Error('Error en la solicitud');
        }

        const data = await response.json();

        clearInterval(timerInterval);
        progressPercentage = 100; // Asegura que el progreso llegue al 100%
        const progressBarFill = document.getElementById('progress-bar-fill');
        const progressText = Swal.getHtmlContainer().querySelector('b');
        progressBarFill.style.width = '100%';
        progressText.textContent = '100%';

        setTimeout(async () => {
            if (data.success) {
                await Swal.fire({
                    title: '¡Éxito!',
                    text: 'La imagen ha sido cargada correctamente.',
                    icon: 'success',
                    didOpen: urlPostDeleteStyle
                });
                await updateSpecificImage(imageUrlGlobal);
            } else {
                Swal.fire({
                    title: 'Error',
                    text: data.message || 'Hubo un problema al cargar la imagen.',
                    icon: 'error',
                    didOpen: urlPostDeleteStyle
                });
            }
        }, 500);

    } catch (error) {
        clearInterval(timerInterval);
        console.error('Error al enviar la imagen:', error);
        Swal.fire('Error', 'Hubo un problema al cargar la imagen.', 'error');
    }
}
async function updateSpecificImage(imageUrl) {
       // Función para intentar recargar la imagen
       const tryToUpdateImage = async (attempts) => {
        if (attempts >= 3) {
            // Si después de 1 minuto no se puede actualizar, recargar la página
            console.log('No se pudo encontrar o actualizar la imagen después de 60 intentos. Recargando la página.');
            location.reload(); // Recargar la página
            return;
        }

        // Buscar la imagen con la URL específica
        const imageElement = document.querySelector(`img[src="${imageUrl}"]`);

        if (!imageElement) {
            // Si no se encuentra la imagen, esperar 1 segundo antes de intentar de nuevo
            console.log('Imagen no encontrada, intentando nuevamente...');
            setTimeout(() => tryToUpdateImage(attempts + 1), 1000);
            return;
        }

        // Crear un objeto Image y establecer la URL de la imagen
        const img = new Image();

        try {
            // Hacer que la imagen se recargue desde el servidor
            const response = await fetch(imageUrl, { cache: "no-store" });

            if (response.ok) {
                // Forzar la recarga de la imagen
                img.src = imageUrl; // Usa la misma URL para la imagen

                // Usar el evento onload para actualizar el src de la imagen en el DOM
                img.onload = function() {
                    imageElement.src = img.src; // Actualizar el src con la nueva imagen recargada
                };

                // Si la imagen se actualizó, salimos del bucle
                return;
            } else {
                console.log('No se pudo recuperar la imagen del servidor');
            }
        } catch (error) {
            console.log('Error al recuperar la imagen:', error);
        }

        // Si no se pudo cargar la imagen, esperar 1 segundo y seguir intentando
        setTimeout(() => tryToUpdateImage(attempts + 1), 1000);
    };

    // Iniciar el intento de actualización
    tryToUpdateImage(0);
}

// Ejecuta `fetchImages` cuando la página se cargue
window.addEventListener('DOMContentLoaded', fetchImages);

$(document).ready( function() {
    $('input[name="tabs"]').on('change',async function() {
        var selectedValue = $(this).val();
        console.log(selectedValue);
        nameFileGallery = selectedValue;
        $(".image-container-option-select").slideUp(400);
        await fetchImages();
        $(".image-container-option-select").slideDown(800);

    });
});


//*
// Inplementacion de arrastre y sulte en todo el body 
// */ 
$(document).ready(function () {
    const overlay = $("#overlay");
    const dropzoneArea = $("#dropzone-area");
    const csrfToken = $('input[name="_token"]').val();
    const allowedFileTypes = ["image/jpeg", "image/png", "image/jpg", "image/gif"];

    if (!overlay.length || !dropzoneArea.length || !csrfToken) {
        console.error("Faltan elementos necesarios (overlay, dropzoneArea o CSRF token).");
        return;
    }

    // Mostrar el overlay y dropzone al arrastrar archivos sobre la página
    $(window).on("dragenter", function (event) {
        if (event.originalEvent.dataTransfer?.types.includes("Files")) {
            overlay.show();
           $(dropzoneArea).css("display", "flex");
        }
    });

    // Ocultar el overlay cuando el ratón sale del área
    overlay.on("dragleave", function (event) {
        if (event.target === overlay[0]) {
            overlay.hide();
            dropzoneArea.hide();
        }
    });

    // Evitar el comportamiento por defecto y mantener el overlay visible
    overlay.on("dragover", function (event) {
        event.preventDefault();
    });

    // Manejar el evento drop
    overlay.on("drop", function (event) {
        event.preventDefault();
        overlay.hide();
        dropzoneArea.hide();

        const files = event.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0]; // Tomar solo el primer archivo

            if (!allowedFileTypes.includes(file.type)) {
                Swal.fire({
                    icon: "info",
                    title: "Archivo no permitido",
                    text: "Este archivo no es válido. Solo se permiten imágenes en formato JPG, JPEG, PNG o GIF.",
                    confirmButtonText: "Entendido",
                    didOpen: urlPostDeleteStyle
                });
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                Swal.fire({
                    title: "¿Deseas guardar esta imagen?",
                    text: "¡Estas a tiempo de modificar su nombre!",
                    imageUrl: e.target.result,
                    imageAlt: "Vista previa de la imagen",
                    showCancelButton: true,
                    confirmButtonText: "Sí, guardar",
                    cancelButtonText: "No, cancelar",
                    reverseButtons: true,
                    input: "text",
                
                    didOpen: () => {
                        $('.swal2-container.swal2-center.swal2-backdrop-show').css('backdrop-filter', 'blur(5px)');
                        $('.image-comparison-alert').css({
                            'display': 'flex',
                            'justify-content': 'center',
                            'align-items': 'center',
                        });
                        $('.icon-alert-comparison').css({
                            'font-size': '2rem',
                            'color': 'var(--dark)',
                            'padding': '20px',
                        });

                        $('.swal2-confirm.swal2-styled.alert-button').css({
                            'width': '45%',
                        });
                        $('.name-frame-data-select-alert').css({
                            'text-align': 'center',
                            'color': 'var(--dark)',
                            'font-style': 'italic',
                            'font-weight': '400',
                        });
                        $('img.swal2-image').css({
                            'max-width': '100%',
                            'min-width': '40%',
                            'margin-bottom': '15px',
                            'border-radius': '5px',
                            'border': '1px dashed #82828278',
                            'max-height': '55vh',
                            'object-fit': 'contain',
                            '-webkit-user-drag': 'none',
                        });
                        $('.swal2-popup.swal2-modal').css({
                            'max-height': '90vh',
                            'max-width': '80%',
                            'width': 'auto',
                            'border-radius': '10px',
                            'user-select': 'none',
                            'justify-items': 'center',
                        });
            
                        $('div:where(.swal2-container) h2:where(.swal2-title)').css({
                            'font-size': '1.5rem',
                            'color': 'var(--dark)',
                        });
                        $('div:where(.swal2-container) div:where(.swal2-footer)').css({
                            'border-top': '1px solid rgb(171 171 171 / 60%)',
            
                        });
                        $('div:where(.swal2-container) img:where(.swal2-image)').css({
                            'margin': '2em 1em 1em',
            
                        });
                        $('div:where(.swal2-container) .swal2-input').css({'text-align':'center'});
                        $('div:where(.swal2-container) .swal2-input').val(file.name.replace(/\.[^/.]+$/, ""));
                    },
                    preConfirm: async (data) => {
                        try {
                            // Expresión regular que permite solo letras, números, guiones y guiones bajos
                            const invalidCharsPattern = /[<>:"/\\|?*]/; // Carácteres no permitidos para nombres de archivo
                
                            // Verificar si el nombre contiene caracteres no permitidos
                            if (invalidCharsPattern.test(data)) {
                                throw new Error('El nombre del archivo contiene caracteres no permitidos. Evita usar < > : " / \\ | ? *');
                            }
                
                            // Validar si el nombre está vacío
                            if (!data.trim()) {
                                throw new Error('El nombre del archivo no puede estar vacío.');
                            }
                
                            return data; // Si pasa la validación, se devuelve el valor
                        } catch (error) {
                            Swal.showValidationMessage(`
                                Request failed: ${error.message}
                            `); // Mostrar el mensaje de error
                        }
                    }
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        // Crear un FormData para enviar los datos
                        const formData = new FormData();
                        formData.append("image", file);   
                        formData.append("image_name", result.value);
                        formData.append("folder_name", nameFileGallery);
                        console.log(result.value);

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
                            if(data.success){
                                Swal.fire({
                                    title: "¡Éxito!", 
                                    text: data.message, 
                                    icon: "success",
                                    confirmButtonText: "Entendido",
                                    didOpen: urlPostDeleteStyle
                                });
                            }else{
                                Swal.fire({
                                    title: "Error!", 
                                    text: data.message,
                                    icon: "error",
                                    confirmButtonText: "Entendido",
                                    didOpen: urlPostDeleteStyle
                                });
                            }
                            fetchImages();

                        } catch (error) {
                            Swal.fire({
                                title: "Error!", 
                                text: "No se pudo subir la imagen.", 
                                icon: "error",
                                confirmButtonText: "Entendido",
                                didOpen: urlPostDeleteStyle
                            });
                            fetchImages();
                        }
                    }
                });
            };

            reader.readAsDataURL(file);
        }
    });
});
