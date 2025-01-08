let storedImages = [];
const templateUrl = '/resources/config/template';
let imageUrlGlobal, imageNameGlobal;
let selectedFile = null;
let nameFileGallery = 'supply';
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
        await fetchImages();
    });
});
