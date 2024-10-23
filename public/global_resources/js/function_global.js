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
