document.addEventListener("DOMContentLoaded", function() {
    const bodyElement = document.body;
    const themeLabel = document.querySelector('.theme-toggle');
    const toggler = document.getElementById('theme-toggle');

    function updateThemeClasses(isDarkMode) {
        themeLabel.classList.toggle('dark-mode-button', isDarkMode);
        themeLabel.classList.toggle('light-mode-button', !isDarkMode);
    }

    const isDarkMode = bodyElement.classList.contains('dark');
    updateThemeClasses(isDarkMode);

    themeLabel.addEventListener('click', function() {
        const newTheme = bodyElement.classList.toggle('dark') ? 'dark' : 'light';
        updateThemeClasses(bodyElement.classList.contains('dark'));
        updateTheme(newTheme);
    });

    toggler.addEventListener('change', function() {
        bodyElement.classList.toggle('dark', this.checked);
        updateThemeClasses(this.checked);
    });

    function updateTheme(theme) {
        fetch(`/switch_theme_?theme=${encodeURIComponent(theme)}`)
            .then(response => response.ok ? console.log('Guardado') : console.error('Error al guardar'))
            .catch(error => console.error('Error:', error));
    }
});

const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () => {
    const isClosed = sideBar.classList.toggle('close');

    fetch(`/update_menu_state?state=${isClosed ? 'close' : 'open'}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'State updated') {
                //console.log('Estado guardado en sesión:', isClosed ? 'Menú cerrado' : 'Menú abierto');
            } else {
                console.error('Error al guardar el estado');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
