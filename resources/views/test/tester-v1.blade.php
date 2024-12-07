<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Boletas</title>
</head>
<body>
    <button id="ver-boleta">Generar Boleta</button>
    <button id="imprimir-boleta" disabled>Imprimir</button>
    <iframe id="visor-pdf" style="width: 100%; height: 500px; border: none;"></iframe>

    <script>
        document.getElementById('ver-boleta').addEventListener('click', async () => {
            try {
                // Parámetros para generar la boleta
                const datos = {
                    fecha: '2024-12-02',
                    cliente: 'Juan Pérez',
                    items: JSON.stringify([
                        { cantidad: 2, producto: 'Café Americano', precio: 5.00 },
                        { cantidad: 1, producto: 'Torta de Chocolate', precio: 10.00 },
                    ]),
                    total: 20.00,
                };

                // Construir la URL
                const queryParams = new URLSearchParams(datos).toString();
                const url = `/view-test-pdf?${queryParams}`;

                // Cargar el PDF en el iframe
                const iframe = document.getElementById('visor-pdf');
                iframe.src = url;

                // Activar el botón de impresión
                document.getElementById('imprimir-boleta').disabled = false;
            } catch (error) {
                console.error(error);
                alert('Hubo un error al generar la boleta.');
            }
        });

        document.getElementById('imprimir-boleta').addEventListener('click', () => {
            const iframe = document.getElementById('visor-pdf');
            iframe.contentWindow.focus(); // Asegurar que el iframe tenga foco
            iframe.contentWindow.print(); // Ejecutar la impresión
        });
    </script>
</body>
</html>
