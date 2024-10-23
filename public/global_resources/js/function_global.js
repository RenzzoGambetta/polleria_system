function urlGet(url, datos = null) {
    if (datos) {
        const params = new URLSearchParams(datos).toString();
        url += '?' + params;
    }
    window.location.href = url;
}
function consultDataUrl(url, datosObj) {
    const params = new URLSearchParams(datosObj).toString();
    const fullUrl = `${url}?${params}`;
    return fetch(fullUrl, {
        method: 'GET'
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta');
            }
            return response.json();
        })
        .then(data => {
            return data;
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
        });
}
