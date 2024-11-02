function urlGet(url, datos = null) {
    if (datos) {
        const params = new URLSearchParams(datos).toString();
        url += '?' + params;
    }
    window.location.href = url;
}
async function consultDataUrl(url, datosObj) {
    const queryParams = new URLSearchParams(datosObj).toString();
    const ref = url + `?${queryParams}`;

    try {
        const response = await fetch(ref);
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
