function urlGet(url, datos = null) {
    if (datos) {
        const params = new URLSearchParams(datos).toString();
        url += '?' + params;
    }
    window.location.href = url;
}
async function consultDataUrl(url, datosObj) {
    const requestId = Date.now();
    this.currentRequestId = requestId;

    const queryParams = new URLSearchParams(
        Object.fromEntries(
            Object.entries(datosObj).filter(([_, value]) => value !== null && value !== undefined)
        )
    ).toString();

    const ref = `${url}?${queryParams}`;

    const controller = new AbortController();
    this.currentRequestController?.abort();
    this.currentRequestController = controller;

    try {
        const response = await fetch(ref, {
            method: 'GET',
            headers: { 'Connection': 'keep-alive' },
            signal: controller.signal,
        });

        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.statusText}`);
        }

        const data = await response.json();

        if (requestId !== this.currentRequestId) {
            return null;
        }

        return data;
    } catch (error) {
        if (error.name === 'AbortError') {
            console.warn('Solicitud abortada:', ref);
        } else {
            console.error('Error:', error.message || error);
        }
        return false;
    }
}


async function consultDataPost(url, datosObj) {
    try {

        const csrfToken = document.querySelector('input[name="_token"]').value;
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(datosObj)
        });

        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.statusText);
        }

        const data = await response.json();
        return data;

    } catch (error) {
        console.error('Error:', error);
        return false;
    }
}

function timeAlert(time) {
    let timeLeft = time;
    const timerElement = $('#timer');
    const alertContainer = $('.container-aler');

    const countdown = setInterval(function() {
        timeLeft--;
        timerElement.text(timeLeft + 's');

        if (timeLeft <= 0) {
            clearInterval(countdown);
            alertContainer.fadeOut(1000);
        }
    }, 2000);
}
function urlPostDeleteStyle() {
    const swalContainer = $('div:where(.swal2-container)');
    swalContainer.css('z-index', 2060);
    swalContainer.find('div:where(.swal2-popup)').css('background-color', 'var(--light)');
    swalContainer.find('h2:where(.swal2-title)').css('color', 'var(--dark)');
    swalContainer.find('.swal2-html-container').css('color', 'var(--dark)');
}

function urlPostDelete(url, datos = null, text, subText) {
    // Mostrar alerta de confirmación con SweetAlert2
    Swal.fire({
        title: text || '¿Estás seguro?',
        text: subText || 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        didOpen: urlPostDeleteStyle
    }).then((result) => {
        if (result.isConfirmed) {
            // Si hay datos, enviar con POST
            if (datos) {
                // Crear un formulario dinámicamente
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                // Agregar los datos al formulario como inputs
                Object.keys(datos).forEach(key => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = datos[key];
                    form.appendChild(input);
                });

                // Seleccionar el token CSRF directamente del input existente
                const csrfToken = document.querySelector('input[name="_token"]').value;
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);

                // Enviar el formulario
                document.body.appendChild(form);
                form.submit();
            }
        }
    });
}
async function loadHtmlFromFile(url) {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Error al cargar el archivo HTML');
        }
        return await response.text();
    } catch (error) {
        console.error(error);
        return '';
    }
}

window.addEventListener('popstate', (event) => {
    event.preventDefault(); 
    Swal.close();
    history.pushState(null, '', location.href);
});

history.pushState(null, '', location.href);
