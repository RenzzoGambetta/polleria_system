document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.submenu-toggle');

    links.forEach(link => {
        link.addEventListener('click', function (event) {
            if (this.id === 'accion') {
                links.forEach(l => {
                    if (l.classList.contains('inav')) {
                        l.classList.remove('inav');
                        l.classList.add('acti');
                    }
                });
                return;
            }

            if (this.classList.contains('acti')) {
                event.preventDefault();
            }

            links.forEach(l => {
                if (l.classList.contains('inav')) {
                    l.classList.remove('inav');
                    l.classList.add('acti');
                }
            });

            this.classList.remove('acti');
            this.classList.add('inav');
        });
    });
});

