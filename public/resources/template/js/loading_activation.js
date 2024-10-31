window.addEventListener('load', function() {
    const loader = document.querySelector('.loader-animation');
    loader.style.transition = 'opacity 0.5s ease';
    loader.style.opacity = '0';

    setTimeout(function() {
        loader.style.display = 'none';
    }, 1000);
});
