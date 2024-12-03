<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <button id="ver-boleta">Generar Boleta</button>
    <iframe id="visor-pdf" style="width: 100%; height: 500px; border: none;"></iframe>
    <script>
        document.getElementById('ver-boleta').addEventListener('click', async () => {
            try {
                const datos = {
                    fecha: '2024-12-02',
                    cliente: 'Juan Pérez',
                    items: [{
                            cantidad: 2,
                            producto: 'Café Americano',
                            precio: 5.00
                        },
                        {
                            cantidad: 1,
                            producto: 'Torta de Chocolate',
                            precio: 10.00
                        },
                    ],
                    total: 20.00,
                };

                const response = await fetch('/generar-pdf', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify(datos),
                });

                if (!response.ok) {
                    throw new Error('Error al generar el PDF');
                }

                const pdfBlob = await response.blob();
                const pdfUrl = URL.createObjectURL(pdfBlob);

                // Mostrar el PDF en un iframe
                const iframe = document.getElementById('visor-pdf');
                iframe.src = pdfUrl;
            } catch (error) {
                console.error(error);
                alert('Hubo un error al generar la boleta.');
            }
        });
    </script>
</body>

</html>
