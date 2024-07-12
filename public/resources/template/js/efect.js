document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todos los enlaces con la clase 'submenu-toggle'
    const links = document.querySelectorAll('.submenu-toggle');

    links.forEach(link => {
        link.addEventListener('click', function (event) {
            // Verifica si el enlace clicado tiene el ID 'accion'
            if (this.id === 'accion') {
                // Revertir todos los enlaces que tienen la clase 'inav' a 'acti'
                links.forEach(l => {
                    if (l.classList.contains('inav')) {
                        l.classList.remove('inav');
                        l.classList.add('acti');
                    }
                });
                // Permite la navegación si el enlace tiene el ID 'accion'
                return;
            }

            // Evitar que los enlaces con la clase 'acti' activen el comportamiento por defecto
            if (this.classList.contains('acti')) {
                event.preventDefault(); // Previene la navegación
            }

            // Revertir todos los enlaces que tienen la clase 'inav' a 'acti'
            links.forEach(l => {
                if (l.classList.contains('inav')) {
                    l.classList.remove('inav');
                    l.classList.add('acti');
                }
            });

            // Elimina la clase 'acti' del enlace clicado y añade la clase 'inav'
            this.classList.remove('acti');
            this.classList.add('inav');
        });
    });
});
