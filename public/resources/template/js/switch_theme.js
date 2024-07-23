document.addEventListener("DOMContentLoaded", function() {
    var bodyElement = document.body;
    var themeLabel = document.querySelector('.theme-toggle');

    themeLabel.addEventListener('click', function() {
        var newTheme = bodyElement.classList.contains('dark') ? 'light' : 'dark';
        bodyElement.classList.toggle('dark');
        updateTheme(newTheme);
    });

    function updateTheme(theme) {
        fetch('/switch_theme_', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ theme: theme })
        });
    }
});
